<?php

namespace sadi01\openbanking\components\finnotech;

interface FinnotechInterface
{
    public function transfer($data);

    /*$destinationNumber,$amount,$description,$reasonDescription,$paymentNumber,$destinationFirstname,$destinationLastname,$customerRef*/
    public function payaTransfer($data);

    /*$amount,$description,$destinationFirstname,$destinationLastname,$destinationNumber,$paymentNumber,$customerRef,$deposit,$sourceFirstName,$sourceLastName,$reasonDescription,$note*/
    public function internalTransfer($data);

    /*$iban*/
    public function shabaInquiry($data);

    /*$deposit,$bankCode*/
    public function depositToShaba($data);

    /*$sayadId*/
    public function checkInquiry($data);

}