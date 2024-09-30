<?php

namespace sadi01\openbanking\components\faraboom;

use sadi01\openbanking\models\BaseOpenBanking;
use Yii;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthRefreshTokens;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\ObOauthClients;
use yii\httpclient\Client;

class Authentication extends BaseAuthentication
{
    const OAUTH_URL = '/oauth/token';

    /**
     * @var ObOauthClients $client
     * */
    public static function getToken($client)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {

            $body = [
                'grant_type' => 'password',
                'username' => $client->username,
                'password' => $client->password,
            ];

            // $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            $headers['App-Key'] = $client->app_key;
            $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_secret");
            $headers['Bank-Id'] = $client->bank_id;
            $headers['CLIENT-DEVICE-ID'] = $client->client_device_id;
            $headers['CLIENT-IP-ADDRESS'] = Yii::$app->request->userIP ?? $client->client_device_id;
            $headers['CLIENT-PLATFORM-TYPE'] = $client->client_platform_type;
            $headers['CLIENT-USER-AGENT'] = Yii::$app->request->userAgent ?? '';
            $headers['CLIENT-USER-ID'] = $client->client_user_id;
            $headers['Content-Type'] = Client::FORMAT_URLENCODED;
            $headers['Device-Id'] = $client->device_id;
            $headers['Token-Id'] = $client->token_id;

            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);

            if ($response['status'] == 200) {
                $result = $response['data'];
                //    print_r($result);die;
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->access_token,
                    'client_id' => (string)ObOauthClients::PLATFORM_FARABOOM,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + $result->expires_in),
                    'scope' => $result->scope,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }

                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refresh_token,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FARABOOM,
                    'expires' => date('Y-m-d H:i:s', time() + $result->expires_in),
                    'scope' => $result->scope,
                ]);

                $refreshToken->save();

                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken, $client);
        }

        return null;
    }

    public static function refreshToken($refresh_token, ObOauthClients $client)
    {
        $body = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token->refresh_token,
            'redirect_uri' => null,
        ];

        $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_secret");;
        $headers['Device-Id'] = $client->device_id;
        $headers['CLIENT-IP-ADDRESS'] = Yii::$app->request->userIP ?? $client->client_device_id;
        $headers['CLIENT-PLATFORM-TYPE'] = $client->client_platform_type;
        $headers['CLIENT-DEVICE-ID'] = $client->client_device_id;
        $headers['CLIENT-USER-ID'] = $client->client_user_id;
        $headers['CLIENT-USER-AGENT'] = Yii::$app->request->userAgent ?? '';

        $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_REFRESH_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);

        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new ObOauthAccessTokens([
                'access_token' => $result->access_token,
                'expires' => time() + $result->expires_in,
                'scope' => $result->scopes,
            ]);
            $accessToken->save();
            return $accessToken->access_token;
        }

        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://oauth.faraboom.co' . $url;
    }

}
