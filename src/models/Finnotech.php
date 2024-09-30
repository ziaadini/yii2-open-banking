<?php

namespace sadi01\openbanking\models;

use Yii;
use yii\base\Model;

class Finnotech extends Model
{
    public $track_id;
    public $slave_id;
    public $client_id;
    public $amount;
    public $description;
    public $destination_firstname;
    public $destination_lastname;
    public $destination_number;
    public $payment_number;
    public $reason_description;
    public $deposit;
    public $source_firstname;
    public $source_lastname;
    public $second_password;
    public $customer_ref;
    public $note;
    public $iban;
    public $sayad_id;
    public $bank_code;
    public $merchant_name;
    public $merchant_iban;

    public $card;
    public $version;
    public $users;
    public $birth_date;
    public $full_name;
    public $first_name;
    public $last_name;
    public $father_name;
    public $gender;
    public $mobile;
    public $national_code;
    public $otp;
    public $user;
    public $redirect_uri;
    public $state;
    public $scope;
    public $code;
    public $bank;
    public $account_owners;
    public $receivers;
    public $signers;
    public $series_no;
    public $serial_no;
    public $from_iban;
    public $due_date;
    public $to_iban;
    public $branch_code;
    public $cheque_type;
    public $cheque_media;
    public $reason;
    public $to_date;
    public $from_date;
    public $to_time;
    public $from_time;
    public $id_type;
    public $id_code;
    public $shahab_id;


    const AYANDEH_BANK_CODE = '062';
    const SCOPE_TRANSFER_TO = 'oak:transfer-to:execute';
    const SCOPE_IBAN_INQUIRY = 'oak:iban-inquiry:get'; //استعلام شماره شبا
    const SCOPE_DEPOSITS = 'oak:deposits:get'; //استعلام حساب ها
    const SCOPE_SAYAD_CHEQUE_INQUIRY = 'credit:sms-sayady-cheque-inquiry:get'; //استعلام چک صیادی
    const SCOPE_SMS_NID_VERIFICATION = 'facility:sms-nid-verification:get'; //احراز هویت
    const SCOPE_SAYAD_ACCEPT_CHEQUE = 'credit:sms-sayad-accept-cheque:post'; //تایید چک صیاد توسط گیرنده
    const SCOPE_SMS_BACK_CHEQUES = 'credit:sms-back-cheques:get'; //استعلام پیامکی چک برگشتی
    const SCOPE_SMS_DEBTS = 'credit:sms-facility-inquiry:get'; //استعلام پیامکی تسهیلات
    const SCOPE_FACILITY_SHAHKAR = 'facility:shahkar:get'; //استعلام پیامکی تسهیلات
    const SCOPE_FACILITY_BANK_INFO = 'facility:cc-bank-info:get'; //سرویس پایه اطلاعات بانکی
    const SCOPE_FACILITY_DEPOSIT_TO_SHABA = 'facility:cc-deposit-iban:get'; //تبدیل حساب به شبا
    const SCOPE_CARD_INFO = 'card:information:get'; // استعلام کارت بانکی
    const SCOPE_NID_VERIFICATION = 'facility:cc-nid-verification:get';// استعلام کد ملی
    const SCOPE_CARD_TO_SHABA = 'facility:card-to-iban:get'; //تبدیل شماره کارت به شبا
    const SCOPE_CARD_TO_DEPOSIT = 'facility:card-to-deposit:get'; //تبدیل شماره کارت به حساب
    const SCOPE_BACK_CHEQUES = 'credit:sms-back-cheques:get'; //استعلام پیامکی چک برگشتی
    const SCOPE_ACCEPT_CHEQUES = 'credit:sms-sayad-accept-cheque:post'; //تایید پیامکی چک صیاد
    const SCOPE_CANCEL_CHEQUES = 'credit:sms-sayad-cancel-cheque:post'; //لغو پیامکی چک صیاد
    const SCOPE_CHEQUE_INQUIRY_BY_RECEIVER = 'credit:sms-sayad-issuer-inquiry-cheque:post'; //استعلام پیامکی چک صیاد توسط گیرنده
    const SCOPE_CHEQUE_INQUIRY_BY_ISSUER = 'credit:sms-sayad-issuer-inquiry-cheque:post'; //استعلام پیامکی چک صیاد توسط صادرکننده
    const SCOPE_CHEQUE_INQUIRY_BY_SMS = 'credit:sms-sayady-cheque-inquiry:get'; //استعلام پیامکی چک صیاد
    const SCOPE_PAYA_TRANSFER = 'oak:paya-transfer:execute'; //انتقال وجه پایا
    const SCOPE_ISSUE_CHEQUE = 'credit:ac-sayad-issue-cheque:post'; //ثبت چک
    const SCOPE_DEPOSIT_STATEMENT = 'oak:statement:get'; //دریافت گردش حساب
    const SCOPE_DEPOSIT_BALANCE = 'oak:balance:get'; //استعلام مانده حساب
    const SCOPE_SMS_FACILITY_INQUIRY = 'credit:sms-facility-inquiry:get'; //استعلام تسهیلات
    const SCOPE_IBAN_OWNER_VERIFICATION = 'kyc:iban-owner-verification:get'; //تطبیق شماره شبا و کد ملی


    const SCENARIO_TRANSFER = 'transfer';
    const SCENARIO_PAYA_TRANSFER = 'paya-transfer';
    const SCENARIO_INTERNAL_TRANSFER = 'internal-transfer';
    const SCENARIO_SHABA_INQUIRY = 'shaba-inquiry';
    const SCENARIO_CHECK_INQUIRY = 'check-inquiry';
    const SCENARIO_DEPOSIT_TO_SHABA = 'deposit-to-shaba';
    const SCENARIO_BANKS_INFO = 'banks-info';
    const SCENARIO_CARD_TO_DEPOSIT = 'card-to-deposit';
    const SCENARIO_CARD_TO_SHABA = 'card-to-shaba';
    const SCENARIO_NID_VERIFICATION = 'nid-verification';
    const SCENARIO_MATCH_MOBILE_NID = 'match-mobile-nid';
    const SCENARIO_CARD_INFO = 'card_info';
    const SCENARIO_DEPOSITS = 'deposits';
    const SCENARIO_BACK_CHEQUES = 'back-cheques';
    const SCENARIO_SAYAD_ACCEPT_CHEQUE = 'sayad-accept-cheque';
    const SCENARIO_SAYAD_CANCEL_CHEQUE = 'sayad-cancel-cheque';
    const SCENARIO_SAYAD_ISSUER_INQUIRY_CHEQUE = 'sayad-issuer-inquiry-cheque';
    const SCENARIO_SAYAD_CHEQUE_INQUIRY = 'sayad-cheque-Inquiry';
    const SCENARIO_SAYAD_ISSUE_CHEQUE = 'sayad-issue-cheque';
    const SCENARIO_SEND_OTP = 'send-otp';
    const SCENARIO_VERIFY_OTP_CODE = 'verify-otp-code';
    const SCENARIO_VERIFY_AC_TOKEN = 'verify-ac-token';
    const SCENARIO_DEPOSIT_STATEMENT = 'deposit-statement';
    const SCENARIO_DEPOSIT_BALANCE = 'deposit-balance';
    const SCENARIO_FACILITY_INQUIRY = 'facility-inquiry';
    const SCENARIO_IBAN_OWNER_VERIFICATION = 'iban-owner-verification';

    public function rules()
    {
        return [
            [['slave_id', 'track_id'], 'required'],
            [['amount', 'description', 'destination_firstname', 'destination_lastname', 'destination_number'
                , 'payment_number', 'reason_description', 'deposit', 'source_firstname', 'source_lastname', 'second_password'], 'required', 'on' => [self::SCENARIO_TRANSFER]],
            [['destination_number', 'amount', 'description', 'reason_description', 'payment_number'
                , 'destination_firstname', 'destination_lastname', 'customer_ref'], 'required', 'on' => [self::SCENARIO_PAYA_TRANSFER]],
            [['amount', 'description', 'destination_firstname', 'destination_lastname', 'destination_number'
                , 'payment_number', 'customer_ref', 'deposit', 'source_firstname', 'source_lastname', 'reason_description', 'note'], 'required', 'on' => [self::SCENARIO_INTERNAL_TRANSFER]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_INQUIRY]],
            [['card', 'version'], 'required', 'on' => [self::SCENARIO_CARD_TO_SHABA]],
            [['card'], 'required', 'on' => [self::SCENARIO_CARD_TO_DEPOSIT,self::SCENARIO_CARD_INFO]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY]],
            [['users'], 'required', 'on' => [self::SCENARIO_DEPOSITS]],
            [['user'], 'required', 'on' => [self::SCENARIO_BACK_CHEQUES, self::SCENARIO_SAYAD_ACCEPT_CHEQUE, self::SCENARIO_SAYAD_CANCEL_CHEQUE, self::SCENARIO_SAYAD_ISSUER_INQUIRY_CHEQUE]],
            [['redirect_uri', 'mobile'], 'required', 'on' => [self::SCENARIO_SEND_OTP]],
            [['otp', 'mobile', 'national_code'], 'required', 'on' => [self::SCENARIO_VERIFY_OTP_CODE]],
            [['user', 'id_type', 'sayad_id'], 'required', 'on' => [self::SCENARIO_SAYAD_CHEQUE_INQUIRY]],
            [['mobile', 'national_code'], 'required', 'on' => [self::SCENARIO_MATCH_MOBILE_NID]],
            [['users', 'birth_date', 'full_name', 'first_name', 'last_name', 'father_name'], 'required', 'on' => [self::SCENARIO_NID_VERIFICATION]],
            [['deposit', 'bank_code'], 'required', 'on' => [self::SCENARIO_DEPOSIT_TO_SHABA]],
            [['deposit'], 'required', 'on' => [self::SCENARIO_DEPOSIT_STATEMENT]],
            [['deposit'], 'required', 'on' => [self::SCENARIO_DEPOSIT_BALANCE]],
            [['user'], 'required', 'on' => [self::SCENARIO_FACILITY_INQUIRY]],
            [['birth_date','national_code','iban'], 'required', 'on' => [self::SCENARIO_IBAN_OWNER_VERIFICATION]],
            [['account_owners','receivers','signers','sayad_id','series_no','serial_no','from_iban','amount','description','due_date','bank_code','branch_code','cheque_type','cheque_media','reason'], 'required', 'on' => [self::SCENARIO_SAYAD_ISSUE_CHEQUE]],
            [['merchant_name', 'merchant_iban', 'state','to_date','from_date','to_time','from_time'], 'string'],
            [['signers'], 'validateSigners', 'on' => self::SCENARIO_SAYAD_ISSUE_CHEQUE],
            [['receivers','account_owners'], 'validateAccountOwnersAndReceivers', 'on' => self::SCENARIO_SAYAD_ISSUE_CHEQUE],
            [['merchant_iban'], 'match', 'pattern' => '/^(?:IR)(?=.{24}$)[0-9]*$/'],
        ];
    }

    public function validateAccountOwnersAndReceivers($attribute, $params)
    {
        $value = $this->$attribute;

        if (!is_array($value)) {
            $this->addError($attribute, 'فیلد باید آرایه باشد');
            return;
        }

        if (count($value) < 1) {
            $this->addError($attribute, "لیست صاحبان حساب ارسال نشده است");
            return;
        }

        foreach ($value as $index => $item) {
            if (!isset($item['name'])) {
                $this->addError($attribute, "نام الزامیست");
                return;
            }
            if (!isset($item['id_code'])) {
                $this->addError($attribute, "کدشناسایی (کدملی/شناسه ملی) الزامیست");
                return;
            }
            if (!isset($item['shahab_id'])) {
                $this->addError($attribute, "کد شهاب الزامیست");
                return;
            }
            if (!isset($item['id_type'])) {
                $this->addError($attribute, "نوع کد شناسایی با ملاحضات: مشتری حقیقی 1 ،مشتری حقوقی 2 الزامیست");
                return;
            }
        }
    }

    public function validateSigners($attribute, $params)
    {
        $value = $this->$attribute;

        if (!is_array($value)) {
            $this->addError($attribute, 'فیلد باید آرایه باشد');
            return;
        }

        if (count($value) < 1) {
            $this->addError($attribute, "لیست امضا کنندگان ارسال نشده است");
            return;
        }

        foreach ($value as $index => $item) {

            if (!isset($item['signer'])) {
                $this->addError($attribute, 'اطلاعات امضا کننده وارد نشده است');
                return;
            }

            if (!isset($item['signer']['name'])) {
                $this->addError($attribute, "نام الزامیست");
                return;
            }
            if (!isset($item['signer']['id_code'])) {
                $this->addError($attribute, "کدشناسایی (کدملی/شناسه ملی) الزامیست");
                return;
            }
            if (!isset($item['signer']['shahab_id'])) {
                $this->addError($attribute, "کد شهاب الزامیست");
                return;
            }
            if (!isset($item['signer']['id_type'])) {
                $this->addError($attribute, "نوع کد شناسایی با ملاحضات: مشتری حقیقی 1 ،مشتری حقوقی 2 الزامیست");
                return;
            }

            if (!isset($item['legal_stamp'])) {
                $this->addError($attribute, "تعیین امضا به منزله مهر حقوقی الزامیست");
                return;
            }
        }
    }


    public function attributeLabels()
    {
        return [
            'track_id' => Yii::t('openBanking', 'شماره پیگیری'),
            'amount' => Yii::t('openBanking', 'Amount'),
            'description' => Yii::t('openBanking', 'Description'),
            'destination_firstname' => Yii::t('openBanking', 'Destination First Name'),
            'destination_number' => Yii::t('openBanking', 'Destination Number'),
            'destination_lastname' => Yii::t('openBanking', 'Destination Last Name'),
            'payment_number' => Yii::t('openBanking', 'Payment Number'),
            'reason_description' => Yii::t('openBanking', 'Reason Description'),
            'deposit' => Yii::t('openBanking', 'Deposit'),
            'source_firstname' => Yii::t('openBanking', 'Source First Name'),
            'source_lastname' => Yii::t('openBanking', 'Source Last Name'),
            'second_password' => Yii::t('openBanking', 'Second Password'),
            'merchant_name' => Yii::t('openBanking', 'Merchant Name'),
            'merchant_iban' => Yii::t('openBanking', 'Merchant Iban'),
            'customer_ref' => Yii::t('openBanking', 'Customer Ref'),
            'note' => Yii::t('openBanking', 'Note'),
            'iban' => Yii::t('openBanking', 'Iban'),
            'bankCode' => Yii::t('openBanking', 'Bank Code'),
            'card' => Yii::t('openBanking', 'Card'),
            'version' => Yii::t('openBanking', 'Version'),
            'birthDate' => Yii::t('openBanking', 'Birth Date'),
            'fullName' => Yii::t('openBanking', 'Full Name'),
            'firstName' => Yii::t('openBanking', 'First Name'),
            'lastName' => Yii::t('openBanking', 'Last Name'),
            'fatherName' => Yii::t('openBanking', 'Father Name'),
            'gender' => Yii::t('openBanking', 'Gender'),
            'mobile' => Yii::t('openBanking', 'Mobile'),
            'national_code' => Yii::t('openBanking', 'National Code'),
            'users' => Yii::t('openBanking', 'Users'),
            'user' => Yii::t('openBanking', 'User'),
            'sayad_id' => Yii::t('openBanking', 'شناسه صیاد'),
            'account_owners' => Yii::t('openBanking', 'account_owners'),
            'receivers' => Yii::t('openBanking', 'receivers'),
            'signers' => Yii::t('openBanking', 'signers'),
            'series_no' => Yii::t('openBanking', 'series_no'),
            'serial_no' => Yii::t('openBanking', 'serial_no'),
            'from_iban' => Yii::t('openBanking', 'from_iban'),
            'due_date' => Yii::t('openBanking', 'due_date'),
            'to_iban' => Yii::t('openBanking', 'to_iban'),
            'branch_code' => Yii::t('openBanking', 'branch_code'),
            'cheque_type' => Yii::t('openBanking', 'cheque_type'),
            'cheque_media' => Yii::t('openBanking', 'cheque_media'),
            'reason' => Yii::t('openBanking', 'reason'),
            'to_date' => Yii::t('openBanking', 'to_date'),
            'from_date' => Yii::t('openBanking', 'from_date'),
            'to_time' => Yii::t('openBanking', 'to_time'),
            'from_time' => Yii::t('openBanking', 'from_time'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_TRANSFER] = ['slave_id', 'track_id', 'amount', 'description', 'destination_firstname', 'destination_lastname',
            'destination_number', 'payment_number', 'deposit', 'source_firstname', 'source_lastname', 'second_password', 'reason_description', 'merchant_name', 'merchant_iban', 'client_id'];
        $scenarios[self::SCENARIO_PAYA_TRANSFER] = ['slave_id', 'track_id', 'destination_number', 'amount', 'description', 'reason_description',
            'payment_number', 'destination_firstname', 'destination_lastname', 'customer_ref', 'client_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'amount', 'description', 'destination_firstname', 'destination_lastname',
            'destination_number', 'payment_number', 'customer_ref', 'deposit', 'source_firstname', 'source_lastname', 'reason_description', 'note', 'client_id'];
        $scenarios[self::SCENARIO_SHABA_INQUIRY] = ['slave_id', 'track_id', 'client_id', 'iban'];
        $scenarios[self::SCENARIO_DEPOSIT_TO_SHABA] = ['slave_id', 'track_id', 'client_id', 'deposit', 'bank_code'];
        $scenarios[self::SCENARIO_CHECK_INQUIRY] = ['sayad_id'];
        $scenarios[self::SCENARIO_BANKS_INFO] = ['client_id', 'track_id'];
        $scenarios[self::SCENARIO_CARD_TO_DEPOSIT] = ['client_id', 'track_id', 'card'];
        $scenarios[self::SCENARIO_CARD_TO_SHABA] = ['client_id', 'track_id', 'card', 'version'];
        $scenarios[self::SCENARIO_NID_VERIFICATION] = ['client_id', 'track_id', 'users', 'birth_date', 'full_name', 'last_name', 'first_name', 'father_name', 'gender'];
        $scenarios[self::SCENARIO_MATCH_MOBILE_NID] = ['client_id', 'track_id', 'mobile', 'national_code'];
        $scenarios[self::SCENARIO_CARD_INFO] = ['client_id', 'track_id', 'card'];
        $scenarios[self::SCENARIO_DEPOSITS] = ['client_id', 'track_id', 'users'];
        $scenarios[self::SCENARIO_BACK_CHEQUES] = ['client_id', 'track_id', 'user'];
        $scenarios[self::SCENARIO_SAYAD_ACCEPT_CHEQUE] = ['client_id', 'track_id', 'user'];
        $scenarios[self::SCENARIO_SAYAD_CANCEL_CHEQUE] = ['client_id', 'track_id', 'user'];
        $scenarios[self::SCENARIO_SAYAD_ISSUER_INQUIRY_CHEQUE] = ['client_id', 'track_id', 'user'];
        $scenarios[self::SCENARIO_SAYAD_CHEQUE_INQUIRY] = ['client_id', 'track_id', 'user', 'id_code', 'shahab_id', 'id_type', 'sayad_id'];
        $scenarios[self::SCENARIO_SEND_OTP] = ['client_id', 'track_id', 'redirect_uri', 'mobile', 'state'];
        $scenarios[self::SCENARIO_VERIFY_OTP_CODE] = ['client_id', 'track_id', 'otp', 'mobile', 'national_code'];
        $scenarios[self::SCENARIO_VERIFY_AC_TOKEN] = ['client_id', 'track_id', 'scope', 'code', 'redirect_uri','bank'];
        $scenarios[self::SCENARIO_DEPOSIT_STATEMENT] = ['client_id', 'track_id', 'deposit', 'to_date', 'from_date','to_time','from_time'];
        $scenarios[self::SCENARIO_SAYAD_ISSUE_CHEQUE] = ['client_id', 'track_id','account_owners','receivers','signers','sayad_id','series_no','serial_no','from_iban','amount','description','due_date','to_iban','bank_code','branch_code','cheque_type','cheque_media','reason'];
        $scenarios[self::SCENARIO_DEPOSIT_BALANCE] = ['client_id', 'track_id','deposit'];
        $scenarios[self::SCENARIO_FACILITY_INQUIRY] = ['client_id', 'track_id','user'];
        $scenarios[self::SCENARIO_IBAN_OWNER_VERIFICATION] = ['client_id', 'track_id','birth_date','nid','iban'];


        return $scenarios;
    }


}
