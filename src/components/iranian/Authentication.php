<?php

namespace sadi01\openbanking\components\iranian;

use Yii;
use yii\httpclient\Client;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthClients;

class Authentication extends BaseAuthentication
{
    const OAUTH_URL = 'connect/token';

    /**
     * @var ObOauthClients $client
     */

    public static function getToken($client)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens) {
            $body = [
                'username' => $client->username,
                'password' => $client->password,
            ];

            $headers = [
                'x-version' => '2.0',
                'Content-Type' => Client::FORMAT_RAW_URLENCODED,
            ];

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

                return $accessToken;
            }
        } else {
            return $accessToken;
        }

        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://app.ics24.ir/' . $url;
    }
}
