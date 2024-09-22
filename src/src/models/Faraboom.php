<?php

namespace sadi01\openbanking\models;

use Yii;
use yii\base\Model;

class Faraboom extends Model
{
    public $track_id;
    public $slave_id;
    public $deposit_number;
    public $iban;
    public $national_code;
    public $account;
    public $source_deposit_number;
    public $iban_number;
    public $owner_name;
    public $amount;
    public $transfer_description;
    public $customer_number;
    public $description;
    public $factor_number;
    public $additional_document_desc;
    public $transaction_reason;
    public $pay_id;
    public $receiver_name;
    public $receiver_family;
    public $destination_iban_number;
    public $receiver_phone_number;
    public $tranaction_reason;
    public $sayad_id;
    public $shaba_number;
    public $mobile;
    public $pan;
    public $ignore_error;
    public $transactions;
    public $source_deposit_iban;
    public $offset;
    public $length;
    public $reference_id;
    public $traco_no;
    public $transaction_id;
    public $from_register_date;
    public $to_register_date;
    public $from_issue_date;
    public $To_issue_date;
    public $from_transaction_amount;
    public $to_transaction_amount;
    public $iban_owner_name;
    public $include_transaction_status;
    public $trace_no;
    public $destination_owner_name;
    public $to_issue_date;
    public $status_set;
    public $transaction_status_set;
    public $transfer_id;
    public $comment;
    public $status;
    public $branch_code;
    public $branch_name;
    public $from_date;
    public $serial;
    public $to_date;
    public $signers;
    public $source_deposit;
    public $destination_deposit;
    public $source_comment;
    public $destination_comment;
    public $reference_number;
    public $destination_batch_transfers;
    public $source_description;

    const SCENARIO_DEPOSIT_TO_SHABA = 'deposit-to-shaba';
    const SCENARIO_SHABA_TO_DEPOSIT = 'shaba-to-deposit';
    const SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT = 'match-national-code-account';
    const SCENARIO_DEPOSIT_HOLDER = 'deposit-holder';
    const SCENARIO_PAYA = 'paya';
    const SCENARIO_SATNA = 'satna';
    const SCENARIO_REPORT_SATNA_TRANSFER = 'report-satna-transfer';
    const SCENARIO_BATCH_SATNA = 'report-batch-satna';
    const SCENARIO_CANCLE_PAYA = 'report-cancle-paya';
    const SCENARIO_REPORT_PAYA_TRANSACTIONS = 'report-paya-transactions';
    const SCENARIO_REPORT_PAYA_TRANSFER = 'report-paya-transfer';
    const SCENARIO_BATCH_PAYA = 'report-batch-paya';
    const SCENARIO_CHECK_INQUIRY_RECEIVER = 'check-inquery-receiver';
    const SCENARIO_MATCH_NATIONAL_CODE_MOBILE = 'match-national-code-mobile';
    const SCENARIO_CART_TO_SHABA = 'cart-to-shaba';
    const SCENARIO_SHABA_INQUIRY = 'shaba-inquery';
    const SCENARIO_INTERNAL_TRANSFER = 'internal-transfer';
    const SCENARIO_BATCH_INTERNAL_TRANSFER = 'batch_internal-transfer';
    const SCENARIO_DEPOSITS = 'deposits';

    const POSA = 'POSA';
    const IOSP = 'IOSP';
    const HIPA = 'HIPA';
    const ISAP = 'ISAP';
    const FXAP = 'FXAP';
    const DRPA = 'DRPA';
    const RTAP = 'RTAP';
    const MPTP = 'MPTP';
    const IMPT = 'IMPT';
    const LMAP = 'LMAP';
    const CDAP = 'CDAP';
    const TCAP = 'TCAP';
    const GEAC = 'GEAC';
    const LRPA = 'LRPA';
    const CCPA = 'CCPA';
    const GPAC = 'GPAC';
    const CPAC = 'CPAC';
    const GPPC = 'GPPC';
    const SPAC = 'SPAC';

    public function rules()
    {
        return [

            [['slave_id', 'track_id'], 'required'],
            [['deposit_number'], 'required', 'on' => [self::SCENARIO_DEPOSIT_TO_SHABA, self::SCENARIO_DEPOSIT_HOLDER]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_TO_DEPOSIT, self::SCENARIO_SHABA_INQUIRY]],
            [['national_code', 'account'], 'required', 'on' => [self::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT]],
            [['iban_number', 'owner_name', 'amount'], 'required', 'on' => [self::SCENARIO_PAYA]],
            [['amount', 'receiver_name', 'receiver_family', 'destination_iban_number'], 'required', 'on' => [self::SCENARIO_SATNA]],
            [['description'], 'required', 'on' => [self::SCENARIO_BATCH_SATNA]],
            [['pan'], 'required', 'on' => [self::SCENARIO_CART_TO_SHABA]],
            [['transfer_id'], 'required', 'on' => [self::SCENARIO_CANCLE_PAYA]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY_RECEIVER]],
            [['national_code', 'mobile'], 'required', 'on' => [self::SCENARIO_MATCH_NATIONAL_CODE_MOBILE]],
            [['source_deposit', 'destination_deposit', 'amount'], 'required', 'on' => [self::SCENARIO_INTERNAL_TRANSFER]],
            [['ignore_error'], 'required', 'on' => [self::SCENARIO_BATCH_INTERNAL_TRANSFER]],
            [['iban'], 'match', 'pattern' => '/^(?:IR)(?=.{24}$)[0-9]*$/'],
            [['deposit_number', 'iban', 'national_code', 'account', 'deposit_number', 'source_deposit_number', 'iban_number', 'owner_name', 'transfer_description', 'customer_number', 'description', 'factor_number'
                , 'additional_document_desc', 'pay_id', 'receiver_name', 'receiver_family', 'destination_iban_number', 'receiver_phone_number', 'branch_name', 'from_date', 'serial', 'trace_no', 'to_date'
                , 'transfer_id', 'comment', 'source_deposit_iban', 'reference_id', 'transaction_id', 'from_register_date', 'to_register_date', 'from_issue_date', 'To_issue_date', 'iban_owner_name'
                , 'source_deposit_iban', 'destination_owner_name', 'additional_document_desc', 'pan', 'sayad_id', 'shaba_number', 'mobile'], 'string'],
            [['source_deposit_number'], 'required', 'on' => [self::SCENARIO_BATCH_PAYA, self::SCENARIO_BATCH_SATNA, self::SCENARIO_BATCH_INTERNAL_TRANSFER, self::SCENARIO_PAYA, self::SCENARIO_SATNA]],
            [['transactions'], 'validatePayaTransaction', 'on' => self::SCENARIO_BATCH_PAYA],
            [['destination_batch_transfers'], 'validateInternalTransaction', 'on' => self::SCENARIO_BATCH_INTERNAL_TRANSFER],
            [['branch_code'], 'integer', 'max' => 16],
            [['transaction_reason'], 'in', 'range' => array_keys(self::itemAlias('TransactionReason'))],
            [['ignore_error'], 'boolean'],
            [['amount'], 'number', 'min' => 10000],
            [['source_deposit', 'destination_deposit'], 'number'],
            [['length', 'offset'], 'integer', 'max' => 64],
        ];

    }

    public function validatePayaTransaction($attribute, $params)
    {
        $value = $this->$attribute;

        if (!is_array($value)) {
            $this->addError($attribute, 'فیلد باید آرایه باشد');
            return;
        }

        if (count($value) < 2) {
            $this->addError($attribute, "تعداد ردیف های حواله گروهی می بایست بیشتر از یک ردیف باشد");
            return;
        }

        foreach ($value as $index => $item) {
            if (!isset($item['iban_number'])) {
                $this->addError($attribute, "شماره شبا الزامیست");
                return;
            }
            if (!isset($item['owner_name'])) {
                $this->addError($attribute, "نام صاحب حساب الزامیست");
                return;
            }
            if (!isset($item['description'])) {
                $this->addError($attribute, "توضیحات الزلمیست");
                return;
            }
            if (!isset($item['amount'])) {
                $this->addError($attribute, "وارد کردن مبلغ الزامیست");
                return;
            }

            if (isset($item['amount']) && $item['amount'] < 10000) {
                $this->addError($attribute, "حداقل مبلغ مجاز 10000 ریال می باشد");
                return;
            }
        }
    }

    public function validateInternalTransaction($attribute, $params)
    {
        $value = $this->$attribute;

        if (!is_array($value)) {
            $this->addError($attribute, 'فیلد باید آرایه باشد');
            return;
        }

        if (count($value) < 2) {
            $this->addError($attribute, "تعداد ردیف های حواله گروهی می بایست بیشتر از یک ردیف باشد");
            return;
        }

        foreach ($value as $index => $item) {
            if (!isset($item['destination_deposit_number'])) {
                $this->addError($attribute, "شماره حساب مقصد الزامیست");
                return;
            }/*
            if (!isset($item['description'])) {
                $this->addError($attribute, "توضیحات الزلمیست");
                return;
            }*/
            if (!isset($item['amount'])) {
                $this->addError($attribute, "وارد کردن مبلغ الزامیست");
                return;
            }

            if (isset($item['amount']) && $item['amount'] < 10000) {
                $this->addError($attribute, "حداقل مبلغ مجاز 10000 ریال می باشد");
                return;
            }
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_DEPOSITS] = ['slave_id', 'track_id'];
        $scenarios[self::SCENARIO_DEPOSIT_TO_SHABA] = ['slave_id', 'track_id', 'deposit_number'];
        $scenarios[self::SCENARIO_SHABA_TO_DEPOSIT] = ['slave_id', 'track_id', 'iban'];
        $scenarios[self::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT] = ['slave_id', 'track_id', 'national_code', 'account'];
        $scenarios[self::SCENARIO_DEPOSIT_HOLDER] = ['slave_id', 'track_id', 'deposit_number'];
        $scenarios[self::SCENARIO_PAYA] = ['slave_id', 'track_id', 'Source_deposit_number', 'iban_number', 'owner_name', 'amount', 'transfer_description', 'customer_number', 'description', 'factor_number', 'additional_document_desc', 'transaction_reason', 'pay_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'source_deposit', 'destination_deposit', 'amount', 'customer_number', 'source_comment', 'destination_comment', 'pay_id', 'reference_number', 'additional_document_desc', 'transaction_reason'];
        $scenarios[self::SCENARIO_SATNA] = ['slave_id', 'track_id', 'amount', 'source_deposit_number', 'receiver_name', 'receiver_family', 'destination_iban_number', 'customer_number', 'receiver_phone_number', 'factor_number', 'description', 'tranaction_reason', 'pay_id'];
        $scenarios[self::SCENARIO_CHECK_INQUIRY_RECEIVER] = ['slave_id', 'track_id', 'sayad_id', 'customer_number'];
        $scenarios[self::SCENARIO_SHABA_INQUIRY] = ['slave_id', 'track_id', 'iban'];
        $scenarios[self::SCENARIO_MATCH_NATIONAL_CODE_MOBILE] = ['slave_id', 'track_id', 'national_code', 'mobile'];
        $scenarios[self::SCENARIO_BATCH_PAYA] = ['slave_id', 'track_id', 'transfer_description', 'customer_number', 'source_deposit_number', 'ignore_error', 'transactions', 'additional_document_desc', 'transaction_reason'];
        $scenarios[self::SCENARIO_REPORT_PAYA_TRANSACTIONS] = ['slave_id', 'track_id', 'source_deposit_iban', 'transfer_description', 'customer_number', 'offset', 'length', 'reference_id', 'traco_no', 'transaction_id', 'from_register_date', 'to_register_date', 'from_issue_date', 'To_issue_date', 'from_transaction_amount', 'to_transaction_amount', 'iban_number', 'iban_owner_name', 'factor_number', 'description', 'include_transaction_status'];
        $scenarios[self::SCENARIO_REPORT_PAYA_TRANSFER] = ['slave_id', 'track_id', 'source_deposit_iban', 'transfer_description', 'customer_number', 'offset', 'length', 'from_transaction_amount', 'to_transaction_amount', 'reference_id', 'trace_no', 'destination_iban_number', 'destination_owner_name', 'from_register_date', 'to_register_date', 'from_issue_date', 'to_issue_date', 'description', 'factor_number', 'status_set', 'transaction_status_set'];
        $scenarios[self::SCENARIO_CANCLE_PAYA] = ['slave_id', 'track_id', 'transfer_id','customer_number', 'transfer_id', 'comment'];
        $scenarios[self::SCENARIO_REPORT_SATNA_TRANSFER] = ['slave_id', 'track_id', 'customer_number', 'status', 'branch_code', 'branch_name', 'from_date', 'length', 'offset', 'serial', 'trace_no', 'to_date'];
        $scenarios[self::SCENARIO_BATCH_SATNA] = ['slave_id', 'track_id', 'source_deposit_number', 'description', 'customer_number', 'transaction_reason', 'signers', 'transactions'];
        $scenarios[self::SCENARIO_BATCH_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'source_deposit_number', 'destination_batch_transfers', 'ignore_error', 'customer_number', 'source_description', 'additional_document_desc', 'signers,$transaction_reason'];

        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'track_id' => Yii::t('openBanking', 'شماره پیگیری'),
            'slave_id' => Yii::t('openBanking', 'شناسه کسب وکار'),
            'deposit_number' => Yii::t('openBanking', ''),
            'iban' => Yii::t('openBanking', 'شماره شبا'),
            'national_code' => Yii::t('openBanking', 'کدملی'),
            'account' => Yii::t('openBanking', 'شماره حساب'),
            'deposit_number' => Yii::t('openBanking', 'شماره حساب'),
            'source_deposit_number' => Yii::t('openBanking', 'شماره حساب مبدا'),
            'iban_number' => Yii::t('openBanking', 'شماره شبا'),
            'owner_name' => Yii::t('openBanking', 'نام صاحب حساب'),
            'amount' => Yii::t('openBanking', 'مبلغ'),
            'transfer_description' => Yii::t('openBanking', 'توضیحات انتقال'),
            'customer_number' => Yii::t('openBanking', 'شماره مشتری'),
            'description' => Yii::t('openBanking', 'توضیحات'),
            'factor_number' => Yii::t('openBanking', ''),
            'additional_document_desc' => Yii::t('openBanking', ''),
            'transaction_reason' => Yii::t('openBanking', ''),
            'pay_id' => Yii::t('openBanking', ''),
            'receiver_name' => Yii::t('openBanking', ''),
            'receiver_family' => Yii::t('openBanking', ''),
            'destination_iban_number' => Yii::t('openBanking', ''),
            'receiver_phone_number' => Yii::t('openBanking', ''),
            'tranaction_reason' => Yii::t('openBanking', ''),
            'sayad_id' => Yii::t('openBanking', 'شناسه صیاد'),
            'shaba_number' => Yii::t('openBanking', 'شماره شبا'),
            'mobile' => Yii::t('openBanking', 'شماره موبایل'),
            'pan' => Yii::t('openBanking', 'شماره کارت'),
            'ignore_error' => Yii::t('openBanking', ''),
            'transactions' => Yii::t('openBanking', ''),
            'source_deposit_iban' => Yii::t('openBanking', ''),
            'offset' => Yii::t('openBanking', ''),
            'length' => Yii::t('openBanking', ''),
            'reference_id' => Yii::t('openBanking', ''),
            'traco_no' => Yii::t('openBanking', ''),
            'transaction_id' => Yii::t('openBanking', ''),
            'from_register_date' => Yii::t('openBanking', ''),
            'to_register_date' => Yii::t('openBanking', ''),
            'from_issue_date' => Yii::t('openBanking', ''),
            'To_issue_date' => Yii::t('openBanking', ''),
            'from_transaction_amount' => Yii::t('openBanking', ''),
            'to_transaction_amount' => Yii::t('openBanking', ''),
            'iban_owner_name' => Yii::t('openBanking', ''),
            'include_transaction_status' => Yii::t('openBanking', ''),
            'trace_no' => Yii::t('openBanking', ''),
            'destination_owner_name' => Yii::t('openBanking', ''),
            'to_issue_date' => Yii::t('openBanking', ''),
            'status_set' => Yii::t('openBanking', ''),
            'transaction_status_set' => Yii::t('openBanking', ''),
            'transfer_id' => Yii::t('openBanking', ''),
            'comment' => Yii::t('openBanking', ''),
            'status' => Yii::t('openBanking', ''),
            'branch_code' => Yii::t('openBanking', ''),
            'branch_name' => Yii::t('openBanking', ''),
            'from_date' => Yii::t('openBanking', ''),
            'serial' => Yii::t('openBanking', ''),
            'to_date' => Yii::t('openBanking', ''),
            'signers' => Yii::t('openBanking', ''),
            'source_deposit' => Yii::t('openBanking', 'سپرده مبدا'),
            'destination_deposit' => Yii::t('openBanking', 'شماره سپرده مقصد'),
            'source_comment' => Yii::t('openBanking', 'شرح انتقال دهنده وجه'),
            'destination_comment' => Yii::t('openBanking', ''),
            'reference_number' => Yii::t('openBanking', 'شماره پیگیری کاربر'),
            'destination_batch_transfers' => Yii::t('openBanking', ''),
            'source_description' => Yii::t('openBanking', ''),
        ];
    }

    public function itemAlias($type, $code = NULL)
    {
        $_items = [
            'TransactionReason' => [
                self::POSA => Yii::t('openBanking', 'POSA'),
                self::IOSP => Yii::t('openBanking', 'IOSP'),
                self::HIPA => Yii::t('openBanking', 'HIPA'),
                self::ISAP => Yii::t('openBanking', 'ISAP'),
                self::FXAP => Yii::t('openBanking', 'FXAP'),
                self::DRPA => Yii::t('openBanking', 'DRPA'),
                self::RTAP => Yii::t('openBanking', 'RTAP'),
                self::MPTP => Yii::t('openBanking', 'MPTP'),
                self::IMPT => Yii::t('openBanking', 'IMPT'),
                self::LMAP => Yii::t('openBanking', 'LMAP'),
                self::CDAP => Yii::t('openBanking', 'CDAP'),
                self::TCAP => Yii::t('openBanking', 'TCAP'),
                self::CDAP => Yii::t('openBanking', 'CDAP'),
                self::GEAC => Yii::t('openBanking', 'GEAC'),
                self::LRPA => Yii::t('openBanking', 'LRPA'),
                self::CCPA => Yii::t('openBanking', 'CCPA'),
                self::GPAC => Yii::t('openBanking', 'GPAC'),
                self::CPAC => Yii::t('openBanking', 'CPAC'),
                self::GPPC => Yii::t('openBanking', 'GPPC'),
                self::SPAC => Yii::t('openBanking', 'SPAC'),
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }


}
