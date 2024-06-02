<?php

namespace sadi01\openbanking\models;

use Yii;
use yii\base\Model;

class Faraboom extends Model
{
    public $track_id;
    public $slave_id;
    public $deposit_id;
    public $iban;
    public $national_code;
    public $account;
    public $deposit_number;
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

    const POSA = 'posa';
    const IOSP = 'posa';
    const HIPA = 'posa';
    const ISAP = 'posa';
    const FXAP = 'posa';
    const DRPA = 'posa';
    const RTAP = 'posa';
    const MPTP = 'posa';
    const IMPT = 'posa';
    const LMAP = 'posa';
    const CDAP = 'posa';
    const TCAP = 'posa';
    const GEAC = 'posa';
    const LRPA = 'posa';
    const CCPA = 'posa';
    const GPAC = 'posa';
    const CPAC = 'posa';
    const GPPC = 'posa';
    const SPAC = 'posa';

    public function rules()
    {
        return [

            [['slave_id', 'track_id'], 'required'],
            [['deposit_id'], 'required', 'on' => [self::SCENARIO_DEPOSIT_TO_SHABA]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_TO_DEPOSIT]],
            [['national_code', 'account'], 'required', 'on' => [self::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT]],
            [['deposit_number'], 'required', 'on' => [self::SCENARIO_DEPOSIT_HOLDER]],
            [['source_deposit_number', 'iban_number', 'owner_name', 'amount'], 'required', 'on' => [self::SCENARIO_PAYA]],
            [['amount', 'source_deposit_number', 'receiver_name', 'receiver_family', 'destination_iban_number'], 'required', 'on' => [self::SCENARIO_SATNA]],
            [['source_deposit_number', 'description'], 'required', 'on' => [self::SCENARIO_BATCH_SATNA]],
            [['pan'], 'required', 'on' => [self::SCENARIO_CART_TO_SHABA]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY_RECEIVER]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_INQUIRY]],
            [['national_code', 'mobile'], 'required', 'on' => [self::SCENARIO_MATCH_NATIONAL_CODE_MOBILE]],
            [['source_deposit', 'destination_deposit', 'amount'], 'required', 'on' => [self::SCENARIO_INTERNAL_TRANSFER]],
            [['source_deposit_number', 'ignore_error'], 'required', 'on' => [self::SCENARIO_BATCH_INTERNAL_TRANSFER]],
            // [[], 'required' , 'on' => [self::SCENARIO_REPORT_SATNA_TRANSFER]],
            // [[], 'required' , 'on' => [self::SCENARIO_CANCLE_PAYA]],
            //[[], 'required' , 'on' => [self::SCENARIO_REPORT_PAYA_TRANSACTIONS]],
            [['iban'], 'match', 'pattern' => '/^(?:IR)(?=.{24}$)[0-9]*$/'],
            [['deposit_id', 'iban', 'national_code', 'account', 'deposit_number', 'source_deposit_number', 'iban_number', 'owner_name', 'transfer_description', 'customer_number', 'description', 'factor_number'
                , 'additional_document_desc', 'pay_id', 'receiver_name', 'receiver_family', 'destination_iban_number', 'receiver_phone_number', 'branch_name', 'from_date', 'serial', 'trace_no', 'to_date'
                , 'transfer_id', 'comment', 'source_deposit_iban', 'reference_id', 'transaction_id', 'from_register_date', 'to_register_date', 'from_issue_date', 'To_issue_date', 'iban_owner_name'
                , 'source_deposit_iban', 'destination_owner_name', 'additional_document_desc', 'pan', 'sayad_id', 'shaba_number', 'mobile'], 'string'],
            //    [['amount','from_transaction_amount','to_transaction_amount'], 'decimal'],
            //  [['signers','transactions','include_transaction_status'.'status_set','transaction_status_set'], 'array'],
            [['source_deposit_number'], 'required', 'on' => [self::SCENARIO_BATCH_PAYA]],
            [['transactions'], 'validatePayaTransaction', 'on' => self::SCENARIO_BATCH_PAYA],
            [['branch_code'], 'integer', 'max' => 16],
            [['transaction_reason'], 'in', 'range' => array_keys(self::itemAlias('TransactionReason'))],
            [['ignore_error'], 'boolean'],
            [['amount'], 'number', 'min' => 10000],
            [['source_deposit', 'destination_deposit'], 'number'],
            [['length', 'offset'], 'integer', 'max' => 64],
            //  [['transaction_reason','status'], 'enum'],
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_DEPOSIT_TO_SHABA] = ['slave_id', 'track_id', 'deposit_id'];
        $scenarios[self::SCENARIO_SHABA_TO_DEPOSIT] = ['slave_id', 'track_id', 'iban'];
        $scenarios[self::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT] = ['slave_id', 'track_id', 'national_code', 'account'];
        $scenarios[self::SCENARIO_DEPOSIT_HOLDER] = ['slave_id', 'track_id', 'deposit_number'];
        $scenarios[self::SCENARIO_PAYA] = ['slave_id', 'track_id', 'Source_deposit_number', 'iban_number', 'owner_name', 'amount', 'transfer_description', 'customer_number', 'description', 'factor_number', 'additional_document_desc', 'transaction_reason', 'pay_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'source_deposit', 'destination_deposit', 'amount', 'customer_number', 'source_comment', 'destination_comment', 'pay_id', 'reference_number', 'additional_document_desc', 'transaction_reason'];
        $scenarios[self::SCENARIO_SATNA] = ['slave_id', 'track_id', 'amount', 'source_deposit_number', 'receiver_name', 'receiver_family', 'destination_iban_number', 'customer_number', 'receiver_phone_number', 'factor_number', 'description', 'tranaction_reason', 'pay_id'];
        $scenarios[self::SCENARIO_CHECK_INQUIRY_RECEIVER] = ['slave_id', 'track_id', 'sayad_id', 'customer_number'];
        $scenarios[self::SCENARIO_SHABA_INQUIRY] = ['slave_id', 'track_id', 'shaba_number'];
        $scenarios[self::SCENARIO_MATCH_NATIONAL_CODE_MOBILE] = ['slave_id', 'track_id', 'national_code', 'mobile'];
        $scenarios[self::SCENARIO_MATCH_NATIONAL_CODE_MOBILE] = ['slave_id', 'track_id', 'national_code', 'mobile'];
        $scenarios[self::SCENARIO_BATCH_PAYA] = ['slave_id', 'track_id', 'transfer_description', 'customer_number', 'source_deposit_number', 'ignore_error', 'transactions', 'additional_document_desc', 'transaction_reason'];
        $scenarios[self::SCENARIO_REPORT_PAYA_TRANSACTIONS] = ['slave_id', 'track_id', 'source_deposit_iban', 'transfer_description', 'customer_number', 'offset', 'length', 'reference_id', 'traco_no', 'transaction_id', 'from_register_date', 'to_register_date', 'from_issue_date', 'To_issue_date', 'from_transaction_amount', 'to_transaction_amount', 'iban_number', 'iban_owner_name', 'factor_number', 'description', 'include_transaction_status'];
        $scenarios[self::SCENARIO_REPORT_PAYA_TRANSFER] = ['slave_id', 'track_id', 'source_deposit_iban', 'transfer_description', 'customer_number', 'offset', 'length', 'from_transaction_amount', 'to_transaction_amount', 'reference_id', 'trace_no', 'destination_iban_number', 'destination_owner_name', 'from_register_date', 'to_register_date', 'from_issue_date', 'to_issue_date', 'description', 'factor_number', 'status_set', 'transaction_status_set'];
        $scenarios[self::SCENARIO_CANCLE_PAYA] = ['slave_id', 'track_id', 'customer_number', 'transfer_id', 'comment'];
        $scenarios[self::SCENARIO_REPORT_SATNA_TRANSFER] = ['slave_id', 'track_id', 'customer_number', 'status', 'branch_code', 'branch_name', 'from_date', 'length', 'offset', 'serial', 'trace_no', 'to_date'];
        $scenarios[self::SCENARIO_BATCH_SATNA] = ['slave_id', 'track_id', 'source_deposit_number', 'description', 'customer_number', 'transaction_reason', 'signers', 'transactions'];
        $scenarios[self::SCENARIO_BATCH_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'source_deposit_number', 'destination_batch_transfers', 'ignore_error', 'customer_number', 'source_description', 'additional_document_desc', 'signers,$transaction_reason'];

        return $scenarios;
    }

    /*public function attributeLabels()
    {
        return [


        ];
    }*/

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
