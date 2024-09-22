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
}