<?php

namespace sadi01\openbanking\components\faraboom;

interface FaraboomInterface
{
    public function depositToShaba($data);

    /*$iban*/
    public function shabaToDeposit($data);

    /*$national_code,$account*/
    public function matchNationalCodeAccount($data);

    /*$deposit_number*/
    public function depositHolder($data);

    /*$source_deposit_number,$iban_number,$owner_name,$amount,$transfer_description,$customer_number,$description,$factor_number,$additional_document_desc,$transaction_reason,$pay_id*/
    public function paya($data);

    //$source_deposit,$destination_deposit,$amount,$customer_number,$source_comment,$destination_comment,$pay_id,$reference_number,$additional_document_desc,$transaction_reason
    public function internalTransfer($data);

    //$source_deposit_number,$destination_batch_transfers,$ignore_error,$customer_number,$source_description,$additional_document_desc,$signers,$transaction_reason
    public function batchInternalTransfer($data);

    public function deposits($data);

    /*$amount,$source_deposit_number,$receiver_name,$receiver_family,$destination_iban_number,$customer_number,$receiver_phone_number,$factor_number,$description,$tranaction_reason,$pay_id*/
    public function satna($data);

    /*$sayad_id,$customer_number*/
    public function checkinquiryReceiver($data);

    /*$shaba_number*/
    public function shabainquiry($data);

    /*$national_code,$mobile*/
    public function matchNationalCodeMobile($data);

    /*$pan*/
    public function cartToShaba($data);

    /*$transfer_description,$customer_number,$source_deposit_number,$ignore_error,$transactions,$additional_document_desc,$transaction_reason*/
    public function batchPaya($data);

    /*$source_deposit_iban,$transfer_description,$customer_number,$offset,$length,$reference_id,$traco_no,$transaction_id,$from_register_date,$to_register_date,$from_issue_date,$To_issue_date,$from_transaction_amount,$to_transaction_amount,$iban_number,$iban_owner_name,$factor_number,$description,$include_transaction_status*/
    public function reportPayaTransactions($data);

    /*$source_deposit_iban,$transfer_description,$customer_number,$offset,$length,$from_transaction_amount,$to_transaction_amount,$reference_id,$trace_no,$destination_iban_number,$destination_owner_name,$from_register_date,$to_register_date,$from_issue_date,$to_issue_date,$description,$factor_number,$status_set,$transaction_status_set*/
    public function reportPayaTransfer($data);

    /*$customer_number,$transfer_id,$comment*/
    public function cancelPaya($data);

    /*$customer_number,$status,$branch_code,$branch_name,$from_date,$length,$offset,$serial,$trace_no,$to_date*/
    public function reportSatnaTransfer($data);

    /*$source_deposit_number,$description,$customer_number,$transaction_reason,$signers,$transactions*/
    public function batchSatna($data);


}