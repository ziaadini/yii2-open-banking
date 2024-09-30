<?php

namespace sadi01\openbanking\components;

use sadi01\openbanking\models\BaseOpenBanking;
use Yii;
use yii\base\Component;
use yii\base\NotSupportedException;

class OpenBanking extends Component implements OpenBankingInterface
{
    const BS_4 = 4;
    const BS_5 = 5;

    public $bsVersion = self::BS_5;
    /**
     * Parameters:
     * string $platform
     * string $service
     * Returns:
     * array
     * */
    public function call($platform, $service, $body)
    {
        $mappedPlatform = BaseOpenBanking::itemAlias('PlatformMap', $platform);
        $mappedService = BaseOpenBanking::itemAlias('ServiceTypeMap', $service);

        if (Yii::$app->has($mappedPlatform) && method_exists(Yii::$app->$mappedPlatform, $mappedService)) {
            return Yii::$app->$mappedPlatform->$mappedService($body);
        } else {
            throw new NotSupportedException('Operation not supported');
        }
    }


    protected function getUrl($platform, $service)
    {

    }

    protected function setErrors($errors)
    {
        $map = [];
        $key = 0;
        foreach ($errors as $item) {
            $itemObj = new \stdClass();
            $itemObj->code = 422;
            $itemObj->message = $item[0];
            $map[$key] = $itemObj;
            $key++;
        }
        $response = new \stdClass();
        $response->success = false;
        $response->status = 422;
        $response->data = null;
        $response->errors = $map;

        return $response;
    }

}