<?php

namespace sadi01\openbanking\components;

interface OpenBankingInterface
{
    public function call($platform,$service,$body);

}