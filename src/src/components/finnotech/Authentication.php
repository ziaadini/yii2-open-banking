<?php

namespace sadi01\openbanking\components\finnotech;

use common\models\User;
use sadi01\openbanking\models\BaseOpenBanking;
use Yii;
use yii\httpclient\Client;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthRefreshTokens;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\ObOauthClients;

class Authentication extends BaseAuthentication
{

    const OAUTH_URL = '/dev/v2/oauth2/token';
    const OAUTH_AUTHORIZE_URL = '/dev/v2/oauth2/authorize';

    /**
     * @var ObOauthClients $client
     * */
    public static function getToken($client, $scope = null)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byScope($scope)->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byScope($scope)->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {
            $body = [
                'grant_type' => 'client_credentials',
                'nid' => $client->nid,
                //'scopes' => 'oak:iban-inquiry:get,facility:cc-deposit-iban:get,facility:cc-bank-info:get,facility:shahkar:get,facility:card-to-deposit:get',
                'scopes' => $scope,
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_password");
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken, $client);
        }
        return null;
    }

    /**
     * @var ObOauthClients $client
     * */
    public static function getSmsToken($client, $scope, $code, $redirect_uri, $national_code)
    {
        $scopes = is_array($scope) ? implode(',', $scope) : $scope;

        $accessToken = ObOauthAccessTokens::find()
            ->notExpire()
            ->andWhere(['JSON_EXTRACT(add_on, "$.national_code")' => $national_code])
            ->byScope($scopes)->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()
            ->notExpire()
            ->andWhere(['JSON_EXTRACT(add_on, "$.national_code")' => $national_code])
            ->byScope($scopes)->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {
            $body = [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'auth_type' => 'SMS',
                'redirect_uri' => $redirect_uri,
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_password");
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'national_code' => $national_code,
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'national_code' => $national_code,
                    'scope' => $scopes,
                ]);
                /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken, $client);
        }
        return null;
    }

    /**
     * @var ObOauthClients $client
     * */
    public static function getAcToken($client, $scope, $code, $redirect_uri, $bank)
    {
        $scopes = is_array($scope) ? implode(',', $scope) : $scope;

        $accessToken = ObOauthAccessTokens::find()
            ->notExpire()
            ->byScope($scopes)->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()
            ->notExpire()
            ->byScope($scopes)->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {
            $body = [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'bank' => $bank ?? '062',
                'redirect_uri' => $redirect_uri,
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_password");
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'national_code' => $national_code,
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'national_code' => $national_code,
                    'scope' => $scopes,
                ]);
                /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
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
            'bank' => $refresh_token->refresh_token,
        ];

        $headers['Content-Type'] = Client::FORMAT_JSON;
        $headers['Authorization'] = 'Basic ' . base64_encode("$client->app_key:$client->app_password");

        $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_REFRESH_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new ObOauthAccessTokens([
                'access_token' => $result->access_token,
                'expires' => time() + $result->lifeTime,
                'scope' => $result->scopes,
            ]);
            $accessToken->save();
            return $accessToken->access_token;
        }
        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://apibeta.finnotech.ir' . $url;
    }
}