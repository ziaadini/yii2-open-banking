<?php

namespace sadi01\openbanking\components\iranian;

use Yii;
use yii\httpclient\Client;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\ObOauthRefreshTokens;

class Authentication extends BaseAuthentication
{
    const OAUTH_URL = 'connect/token';

    /**
     * @var ObOauthClients $client
     * */
    public static function getToken($client)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {

            $body = [
                'username' => $client->username,
                'password' => $client->password,
            ];


            $headers['x-version'] = '2.0';
            $headers['Content-Type'] = 'application/x-www-form-' . Client::FORMAT_JSON;

            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_IRABIAN, BaseOpenBanking::IRANIAN_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);

            if ($response['status'] == 200) {
                $result = $response['data'];
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->access_token,
                    'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + $result->expires_in),
                    'scope' => $result->scope,
                    'api_key'=>$result->api_key,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }

                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refresh_token,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                    'expires' => date('Y-m-d H:i:s', time() + $result->expires_in),
                    'scope' => $result->scope,
                ]);

                $refreshToken->save();

                return $accessToken;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken,$accessToken, $client);
        }

        return null;
    }

    public static function refreshToken($refresh_token,$access_toekn, ObOauthClients $client)
    {
        $body = [
            'AccessToken' => $access_toekn->access_token,
            'RefreshToken' => $refresh_token->refresh_token,
        ];

        $headers['x-version'] = '2.0';
        $headers['Content-Type'] = 'application/x-www-form-' . Client::FORMAT_JSON;

        $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_IRABIAN, BaseOpenBanking::IRANIAN_REFRESH_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);

        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new ObOauthAccessTokens([
                'access_token' => $result->access_token,
                'expires' => time() + $result->expires_in,
                'scope' => $result->scope,
            ]);
            $accessToken->save();
            return $accessToken->access_token;
        }

        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://app.ics24.ir/' . $url;
    }
}