<?php
namespace sadi01\openbanking;

use WebApplication;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {

        if (!isset($app->get('i18n')->translations['openBanking*'])) {
            $app->get('i18n')->translations['openBanking*'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'openBanking' => 'main.php',
                ],
            ];
        }

        Yii::$app->setComponents([
            'apiClient' => [
                'class' => 'sadi01\openbanking\HttpHandler\ApiClient',
            ],
            'apiException' => [
                'class' => 'sadi01\openbanking\HttpHandler\ApiException',
            ],
            'faraboom' => [
                'class' => 'sadi01\openbanking\components\faraboom\Faraboom',
            ],
            'finnotech' => [
                'class' => 'sadi01\openbanking\components\finnotech\Finnotech',
            ],
            'shahkar' => [
                'class' => 'sadi01\openbanking\components\shahkar\Shahkar',
            ],
            'iranian' => [
                'class' => 'sadi01\openbanking\components\iranian\Iranian',
            ],
        ]);


    }



}