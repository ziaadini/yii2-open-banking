<?php

namespace sadi01\openbanking\components\iranian;

interface IranianInterface
{

    public function request($data);


    public function validate($data);


    public function status($data);


    public function reGenerateReport($data);


    public function reportXml($data);


    public function reportPdf($data);

}
