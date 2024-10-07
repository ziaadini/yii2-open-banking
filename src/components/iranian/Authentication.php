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


            $headers = [
                'x-version' => '2.0',
            ];
            $headers['Content-Type'] = Client::FORMAT_RAW_URLENCODED;
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_IRABIAN, BaseOpenBanking::IRANIAN_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data'];
                if ($result->hasError) {
                    print_r($result);
                    die;
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->data->accessToken,
                    'api_key' => $result->data->apiKey,
                    'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', strtotime('+12 hour')),
                ]);

                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }

                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->data->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                    'expires' => date('Y-m-d H:i:s', strtotime('+1 day')),
                ]);

                $refreshToken->save();


                return $accessToken;

            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken, $client);
        }

        return null;
    }

    public static function refreshToken($refresh_token, ObOauthClients $client)
    {
        $accessToken = ObOauthAccessTokens::find()
            ->byClientId($client->client_id)
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();

        $body = [
            'AccessToken' => $accessToken->access_token,
            'RefreshToken' => $refresh_token->refresh_token,
        ];


        $headers['x-version'] = '2.0';
        $headers['Content-Type'] = Client::FORMAT_RAW_URLENCODED;
        $response = Yii::$app->apiClient->put(ObOauthClients::PLATFORM_IRABIAN, BaseOpenBanking::IRANIAN_REFRESH_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);


        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new ObOauthAccessTokens([
                'access_token' => $result->data->accessToken,
                'api_key' => $accessToken->apiKey,
                'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                'user_id' => Yii::$app->user->id,
                'expires' => date('Y-m-d H:i:s', strtotime('+12 hour')),
            ]);
            $accessToken->save();
            $refreshToken = new ObOauthRefreshTokens([
                'refresh_token' => $result->data->refreshToken,
                'user_id' => Yii::$app->user->id,
                'client_id' => (string)ObOauthClients::PLATFORM_IRABIAN,
                'expires' => date('Y-m-d H:i:s', strtotime('+1 day')),
            ]);
            $refreshToken->save();
            return $accessToken;
        } else {
            print_r($response);
            die;
        }
        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://app.ics24.ir/' . $url;
    }
}
