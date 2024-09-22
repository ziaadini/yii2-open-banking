<?php

namespace sadi01\openbanking\helpers;

class ResponseHelper
{
    public static function mapFaraboom($response)
    {
        $errors = null;
        $mapedResponse = new \stdClass();
        if (isset($response['data']->errors)) {
            $errors = $response['data']->errors;
            unset($response['data']->errors);
        }

        $mapedResponse->success = $response['success'];
        $mapedResponse->status = $response['status'];
        $mapedResponse->data = $response['data'];
        $mapedResponse->errors = $errors;
        return $mapedResponse;
    }


    public static function mapIranian($response)
    {
        $mapedResponse = new \stdClass();
        $mapedResponse->errors = $response['Messages'];
        $mapedResponse->success = $response['HasError'];
        $mapedResponse->data = $response['Data'];
        return $mapedResponse;
    }
}