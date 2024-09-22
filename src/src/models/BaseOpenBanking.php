<?php

namespace sadi01\openbanking\models;

use Yii;

class BaseOpenBanking extends \yii\db\ActiveRecord
{
    public $platform;
    public $service;
    public $object;

    const PLATFORM_FARABOOM = 1;
    const PLATFORM_FINNOTECH = 2;
    const PLATFORM_SHAHIN = 3;
    const PLATFORM_SHAHKAR = 4;
    const PLATFORM_IRANIAN = 5;

    const FARABOOM_BASE_URL = 'https://api.faraboom.co/v1/';
    const FINNOTECH_BASE_URL = 'https://apibeta.finnotech.ir';
    const IRANIAN_BASE_URL = 'https://app.ics24.ir/b2b/api';

    const FARABOOM_GET_TOKEN = 1;
    const FARABOOM_DEPOSIT_TO_SHABA = 2;
    const FARABOOM_SHABA_TO_DEPOSIT = 3;
    const FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT = 4;
    const FARABOOM_DEPOSIT_HOLDER = 5;
    const FARABOOM_PAYA = 6;
    const FARABOOM_SATNA = 7;
    const FARABOOM_CHECK_INQUIRY_RECEIVER = 8;
    const FARABOOM_SHABA_INQUIRY = 9;
    const FARABOOM_MATCH_NATIONAL_CODE_MOBILE = 10;
    const FARABOOM_CART_TO_SHABA = 11;
    const FARABOOM_BATCH_PAYA = 12;
    const FARABOOM_REPORT_PAYA_TRANSACTIONS = 13;
    const FARABOOM_REPORT_PAYA_TRANSFER = 14;
    const FARABOOM_CANCLE_PAYA = 15;
    const FARABOOM_REPORT_SATNA_TRANSFER = 16;
    const FARABOOM_BATCH_SATNA = 17;
    const FARABOOM_INTERNAL_TRANSFER = 18;
    const FARABOOM_BATCH_INTERNAL_TRANSFER = 19;
    const FARABOOM_DEPOSITS = 20;

    const FARABOOM_REFRESH_TOKEN = 21;
    const FINNOTECH_REFRESH_TOKEN = 22;
    const FINNOTECH_TRANSFER = 23;
    const FINNOTECH_PAYA_TRANSFER = 24;
    const FINNOTECH_INTERNAL_TRANSFER = 25;
    const FINNOTECH_SHABA_INQUIRY = 26;
    const FINNOTECH_DEPOSIT_TO_SHABA = 27;
    const FINNOTECH_CHECK_INQUIRY = 28;
    const FINNOTECH_GET_TOKEN = 29;
    const FINNOTECH_GO_TO_AUTHORIZE = 30;
    const FINNOTECH_GET_AUTHORIZE_TOKEN = 31;
    const FINNOTECH_BANKS_INFO = 32;
    const FINNOTECH_CARD_TO_DEPOSIT = 33;
    const FINNOTECH_CARD_TO_SHABA = 34;
    const FINNOTECH_NID_VERIFICATION = 35;
    const FINNOTECH_MATCH_MOBILE_NID = 36;
    const FINNOTECH_CARD_INFO = 37;
    const FINNOTECH_DEPOSITS = 38;
    const FINNOTECH_SEND_OTP = 39;
    const FINNOTECH_VERIFY_OTP = 40;
    const FINNOTECH_BACK_CHEQUES = 41;
    const FINNOTECH_SAYAD_ACCEPT_CHEQUE = 42;
    const FINNOTECH_SAYAD_CANCEL_CHEQUE = 43;
    const FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE = 44;
    const FINNOTECH_SAYAD_CHEQUE_INQUIRY = 45;
    const FINNOTECH_VERIFY_AC_TOKEN = 46;
    const FINNOTECH_SAYAD_ISSUE_CHEQUE = 47;
    const FINNOTECH_DEPOSIT_STATEMENT = 48;
    const FINNOTECH_DEPOSIT_BALANCE = 49;
    const FINNOTECH_FACILITY_INQUIRY = 50;
    const FINNOTECH_IBAN_OWNER_VERIFICATION = 51;


    const IRANIAN_GET_TOKEN = 52;
    const IRANIAN_REFRESH_TOKEN = 53;
    const IRANIAN_REQUEST = 54;
    const IRANIAN_RE_NEW_TOKEN = 60;
    const IRANIAN_VALIDATE = 55;
    const IRANIAN_STATUS = 56;
    const IRANIAN_REGENERATE_REPORT = 57;
    const IRANIAN_REPORT_XML = 58;
    const IRANIAN_REPORT_PDF = 59;


    public function rules()
    {
        return [
            [['platform', 'service', 'object'], 'required'],
            [['platform', 'service'], 'string'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'platform' => Yii::t('openBanking', 'Platform'),
            'service' => Yii::t('openBanking', 'Servive'),
            'object' => Yii::t('openBanking', 'Object'),
        ];
    }

    public static function itemAlias($type, $code = NULL, $params = null)
    {
        $_items = [
            'PlatformMap' => [
                self::PLATFORM_FINNOTECH => 'finnotech',
                self::PLATFORM_FARABOOM => 'faraboom',
                self::PLATFORM_SHAHIN => 'Shahin',
                self::PLATFORM_SHAHKAR => 'Shahkar',
                self::PLATFORM_IRANIAN => 'iranian',
            ],
            'Platform' => [
                self::PLATFORM_FINNOTECH => Yii::t('openBanking', 'Finnotech'),
                self::PLATFORM_FARABOOM => Yii::t('openBanking', 'Faraboom'),
                self::PLATFORM_SHAHIN => Yii::t('openBanking', 'Shahin'),
                self::PLATFORM_SHAHKAR => Yii::t('openBanking', 'Shahkar'),
                self::PLATFORM_IRANIAN => Yii::t('openBanking', 'Iranian'),
            ],
            'ServiceType' => [
                self::FARABOOM_GET_TOKEN => Yii::t('openBanking', 'Get faraboom token'),
                self::FARABOOM_REFRESH_TOKEN => Yii::t('openBanking', 'refresh faraboom token'),
                self::FARABOOM_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Deposit To Shaba'),
                self::FARABOOM_SHABA_TO_DEPOSIT => Yii::t('openBanking', 'Shaba To Deposit'),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => Yii::t('openBanking', 'Match National Code Account'),
                self::FARABOOM_DEPOSIT_HOLDER => Yii::t('openBanking', 'Deposit Holder'),
                self::FARABOOM_PAYA => Yii::t('openBanking', 'Paya'),
                self::FARABOOM_SATNA => Yii::t('openBanking', 'Satna'),
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => Yii::t('openBanking', 'Check Inquery Receiver'),
                self::FARABOOM_SHABA_INQUIRY => Yii::t('openBanking', 'Shaba Inquiry'),
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => Yii::t('openBanking', 'Match National Code Mobile'),
                self::FARABOOM_CART_TO_SHABA => Yii::t('openBanking', 'Cart To Shaba'),
                self::FARABOOM_BATCH_PAYA => Yii::t('openBanking', 'Batch Paya'),
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => Yii::t('openBanking', 'Report Paya Transactions'),
                self::FARABOOM_REPORT_PAYA_TRANSFER => Yii::t('openBanking', 'Paya Transfer'),
                self::FARABOOM_CANCLE_PAYA => Yii::t('openBanking', 'Cancel Paya'),
                self::FARABOOM_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Report Satna Transfer'),
                self::FARABOOM_BATCH_SATNA => Yii::t('openBanking', 'Batch Satna'),
                self::FARABOOM_INTERNAL_TRANSFER => Yii::t('openBanking', ' Internal Transfer'),
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Batch Internal Transfer'),
                self::FARABOOM_DEPOSITS => Yii::t('openBanking', 'Deposits'),
                self::FINNOTECH_GO_TO_AUTHORIZE => Yii::t('openBanking', 'goToAuthorize'),
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => Yii::t('openBanking', 'Get Finnot Auth Token'),
                self::FINNOTECH_TRANSFER => Yii::t('openBanking', 'Transfer'),
                self::FINNOTECH_PAYA_TRANSFER => Yii::t('openBanking', 'Paya Transfer'),
                self::FINNOTECH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Internal Transfer'),
                self::FINNOTECH_SHABA_INQUIRY => Yii::t('openBanking', 'Shaba Inquiry'),
                self::FINNOTECH_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Deposit To Shaba'),
                self::FINNOTECH_CHECK_INQUIRY => Yii::t('openBanking', 'Check Inquiry'),
                self::FINNOTECH_GET_TOKEN => Yii::t('openBanking', 'Get finnotech token'),
                self::FINNOTECH_BANKS_INFO => Yii::t('openBanking', 'Banks Info'),
                self::FINNOTECH_CARD_TO_DEPOSIT => Yii::t('openBanking', 'Card To Deposit'),
                self::FINNOTECH_CARD_TO_SHABA => Yii::t('openBanking', 'Card To Shaba'),
                self::FINNOTECH_NID_VERIFICATION => Yii::t('openBanking', 'Nid Verification'),
                self::FINNOTECH_MATCH_MOBILE_NID => Yii::t('openBanking', 'Match Mobile Nid'),
                self::FINNOTECH_CARD_INFO => Yii::t('openBanking', 'Card Info'),
                self::FINNOTECH_DEPOSITS => Yii::t('openBanking', 'Deposits'),
                self::FINNOTECH_SEND_OTP => Yii::t('openBanking', 'Send Otp Request'),
                self::FINNOTECH_VERIFY_OTP => Yii::t('openBanking', 'Verify Otp Request'),
                self::FINNOTECH_VERIFY_AC_TOKEN => Yii::t('openBanking', 'Verify Authorize Token'),
                self::FINNOTECH_BACK_CHEQUES => Yii::t('openBanking', 'Back Cheques'),
                self::FINNOTECH_SAYAD_ACCEPT_CHEQUE => Yii::t('openBanking', 'Sayad Accept Cheque'),
                self::FINNOTECH_SAYAD_CANCEL_CHEQUE => Yii::t('openBanking', 'Sayad Cancel Cheque'),
                self::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE => Yii::t('openBanking', 'Sayad Issuer Inquiry Cheque'),
                self::FINNOTECH_SAYAD_CHEQUE_INQUIRY => Yii::t('openBanking', 'Sayad Cheque Inquiry'),
                self::FINNOTECH_SAYAD_ISSUE_CHEQUE => Yii::t('openBanking', 'Sayad Issue Cheque'),
                self::FINNOTECH_DEPOSIT_STATEMENT => Yii::t('openBanking', 'Dposit Statement'),
                self::FINNOTECH_DEPOSIT_BALANCE => Yii::t('openBanking', 'Dposit Balance'),
                self::FINNOTECH_FACILITY_INQUIRY => Yii::t('openBanking', 'Facility Inquiry'),
                self::FINNOTECH_IBAN_OWNER_VERIFICATION => Yii::t('openBanking', 'Iban Owner Verification'),
                self::IRANIAN_GET_TOKEN => Yii::t('openBanking', 'Get Iranian Token'),
                self::IRANIAN_REFRESH_TOKEN => Yii::t('openBanking', 'Refresh Iranian Token'),
                self::IRANIAN_REQUEST => Yii::t('openBanking', 'Request Service'),
                self::IRANIAN_RE_NEW_TOKEN => Yii::t('openBanking', 'Request ReNew Token'),
                self::IRANIAN_VALIDATE => Yii::t('openBanking', 'Validate Request'),
                self::IRANIAN_STATUS => Yii::t('openBanking', 'Check Request Status'),
                self::IRANIAN_REGENERATE_REPORT => Yii::t('openBanking', 'Regenerate Report'),
                self::IRANIAN_REPORT_XML => Yii::t('openBanking', 'Generate Report in XML'),
                self::IRANIAN_REPORT_PDF => Yii::t('openBanking', 'Generate Report in PDF'),
            ],
            'ServiceTypeMap' => [
                self::FARABOOM_GET_TOKEN => 'token',
                self::FARABOOM_REFRESH_TOKEN => 'token',
                self::FINNOTECH_GET_TOKEN => 'token',
                self::FARABOOM_DEPOSIT_TO_SHABA => 'depositToShaba',
                self::FARABOOM_SHABA_TO_DEPOSIT => 'shabaToDeposit',
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => 'matchNationalCodeAccount',
                self::FARABOOM_DEPOSIT_HOLDER => 'depositHolder',
                self::FARABOOM_PAYA => 'paya',
                self::FARABOOM_SATNA => 'satna',
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => 'checkinquiryReceiver',
                self::FARABOOM_SHABA_INQUIRY => 'shabainquiry',
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => 'matchNationalCodeMobile',
                self::FARABOOM_CART_TO_SHABA => 'cartToShaba',
                self::FARABOOM_BATCH_PAYA => 'batchPaya',
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => 'reportPayaTransactions',
                self::FARABOOM_REPORT_PAYA_TRANSFER => 'reportPayaTransfer',
                self::FARABOOM_CANCLE_PAYA => 'cancelPaya',
                self::FARABOOM_REPORT_SATNA_TRANSFER => 'reportSatnaTransfer',
                self::FARABOOM_BATCH_SATNA => 'batchSatna',
                self::FARABOOM_INTERNAL_TRANSFER => 'internalTransfer',
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => 'batchInternalTransfer',
                self::FARABOOM_DEPOSITS => 'deposits',
                self::FINNOTECH_GO_TO_AUTHORIZE => 'goToAuthorize',
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => 'getAuthorizeToken',
                self::FINNOTECH_TRANSFER => 'transfer',
                self::FINNOTECH_PAYA_TRANSFER => 'payaTransfer',
                self::FINNOTECH_INTERNAL_TRANSFER => 'InternalTransfer',
                self::FINNOTECH_SHABA_INQUIRY => 'shabaInquiry',
                self::FINNOTECH_DEPOSIT_TO_SHABA => 'depositToShaba',
                self::FINNOTECH_CHECK_INQUIRY => 'checkInquiry',
                self::FINNOTECH_BANKS_INFO => 'banksInfo',
                self::FINNOTECH_CARD_TO_DEPOSIT => 'cardToDeposit',
                self::FINNOTECH_CARD_TO_SHABA => 'cardToShaba',
                self::FINNOTECH_NID_VERIFICATION => 'nidVerification',
                self::FINNOTECH_MATCH_MOBILE_NID => 'matchMobileNid',
                self::FINNOTECH_CARD_INFO => 'cardInfo',
                self::FINNOTECH_DEPOSITS => 'deposits',
                self::FINNOTECH_SEND_OTP => 'sendOtpAuthorizeCode',
                self::FINNOTECH_VERIFY_OTP => 'verifyOtpCode',
                self::FINNOTECH_VERIFY_AC_TOKEN => 'verifyAcToken',
                self::FINNOTECH_BACK_CHEQUES => 'backCheques',
                self::FINNOTECH_SAYAD_ACCEPT_CHEQUE => 'sayadAcceptCheque',
                self::FINNOTECH_SAYAD_CANCEL_CHEQUE => 'sayadCancelCheque',
                self::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE => 'sayadIssuerInquiryCheque',
                self::FINNOTECH_SAYAD_CHEQUE_INQUIRY => 'sayadChequeInquiry',
                self::FINNOTECH_SAYAD_ISSUE_CHEQUE => 'sayadIssueCheque',
                self::FINNOTECH_DEPOSIT_STATEMENT => 'depositStatement',
                self::FINNOTECH_DEPOSIT_BALANCE => 'depositBalance',
                self::FINNOTECH_FACILITY_INQUIRY => 'facilityInquiry',
                self::FINNOTECH_IBAN_OWNER_VERIFICATION => 'ibanOwnerVerification',
                self::IRANIAN_GET_TOKEN => 'iranianGetToken',
                self::IRANIAN_REFRESH_TOKEN => 'iranianRefreshToken',
                self::IRANIAN_REQUEST => 'iranianRequestService',
                self::IRANIAN_RE_NEW_TOKEN => 'iranianReNewToken',
                self::IRANIAN_VALIDATE => 'iranianValidateRequest',
                self::IRANIAN_STATUS => 'iranianCheckStatus',
                self::IRANIAN_REGENERATE_REPORT => 'iranianRegenerateReport',
                self::IRANIAN_REPORT_XML => 'iranianReportXml',
                self::IRANIAN_REPORT_PDF => 'iranianReportPdf',
            ],
            'ServiceUrl' => [
                self::FARABOOM_GET_TOKEN => self::FARABOOM_BASE_URL,
                self::FARABOOM_REFRESH_TOKEN => self::FARABOOM_BASE_URL,
                self::IRANIAN_GET_TOKEN => self::FARABOOM_BASE_URL,
                self::IRANIAN_REFRESH_TOKEN => self::FARABOOM_BASE_URL,
                self::FINNOTECH_REFRESH_TOKEN => self::FINNOTECH_BASE_URL,
                self::FINNOTECH_GET_TOKEN => self::FINNOTECH_BASE_URL,
                self::FARABOOM_DEPOSIT_TO_SHABA => self::FARABOOM_BASE_URL . 'deposits/' . (is_array($params) ? null : $params),
                self::FARABOOM_SHABA_TO_DEPOSIT => self::FARABOOM_BASE_URL . 'ibans/' . (is_array($params) ? null : $params),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => self::FARABOOM_BASE_URL . 'deposits/account/national-code',
                self::FARABOOM_DEPOSIT_HOLDER => self::FARABOOM_BASE_URL . 'deposits/' . (is_array($params) ? null : $params) . '/holder',
                self::FARABOOM_PAYA => self::FARABOOM_BASE_URL . 'ach/transfer/normal',
                self::FARABOOM_SATNA => self::FARABOOM_BASE_URL . 'rtgs/transfer',
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => self::FARABOOM_BASE_URL . 'cheques/sayad/holder/inquiry',
                self::FARABOOM_SHABA_INQUIRY => self::FARABOOM_BASE_URL . 'ach/iban/' . (is_array($params) ? null : $params) . '/info',
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => self::FARABOOM_BASE_URL . 'mobile/national-code',
                self::FARABOOM_CART_TO_SHABA => self::FARABOOM_BASE_URL . 'cards/' . (is_array($params) ? null : $params) . '/iban',
                self::FARABOOM_BATCH_PAYA => self::FARABOOM_BASE_URL . 'ach/transfer/batch',
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => self::FARABOOM_BASE_URL . 'ach/reports/transaction',
                self::FARABOOM_REPORT_PAYA_TRANSFER => self::FARABOOM_BASE_URL . 'ach/reports/transfer',
                self::FARABOOM_CANCLE_PAYA => self::FARABOOM_BASE_URL . 'ach/cancel/transfer/' . (is_array($params) ? null : $params),
                self::FARABOOM_REPORT_SATNA_TRANSFER => self::FARABOOM_BASE_URL . 'rtgs/transfer/report',
                self::FARABOOM_BATCH_SATNA => self::FARABOOM_BASE_URL . 'rtgs/transfer/batch',
                self::FARABOOM_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . 'deposits/transfer/normal',
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . 'deposits/transfer/batch',
                self::FARABOOM_DEPOSITS => self::FARABOOM_BASE_URL . 'deposits',
                self::FINNOTECH_GO_TO_AUTHORIZE => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/authorize?' . (is_array($params) ? http_build_query($params) : ''),
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/token',
                self::FINNOTECH_DEPOSIT_TO_SHABA => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/depositToIban', 'trackId' => $params['track_id'] ?? '', 'bankCode' => $params['bank_code'] ?? '', 'deposit' => $params['deposit'] ?? ''],
                self::FINNOTECH_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/cc/transferTo', 'trackId' => $params['trackId'] ?? ''],
                self::FINNOTECH_PAYA_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/payaTransferRequest', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_INTERNAL_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/internalTransferRequest', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SHABA_INQUIRY => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/ibanInquiry', 'trackId' => $params['track_id'] ?? '', 'iban' => $params['iban'] ?? ''],
                self::FINNOTECH_CHECK_INQUIRY => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/sayadSerialInquiry', 'trackId' => $params['track_id'] ?? '', 'sayadId' => $params['sayad_id'] ?? ''],
                self::FINNOTECH_BANKS_INFO => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/banksInfo', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_CARD_TO_DEPOSIT => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/cardToDeposit', 'trackId' => ($params['track_id'] ?? ''), 'card' => ($params['card'] ?? '')],
                self::FINNOTECH_CARD_TO_SHABA => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/cardToIban', 'trackId' => $params['track_id'] ?? '', 'card' => $params['card'] ?? ''],
                self::FINNOTECH_NID_VERIFICATION => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['users'] ?? '') . '/cc/nidVerification', 'trackId' => $params['track_id'] ?? '', 'birthDate' => $params['birthDate'] ?? '',
                    'gender' => $params['gender'] ?? '', 'fullName' => $params['fullName'] ?? '', 'firstName' => $params['firstName'] ?? '', 'lastName' => $params['lastName'] ?? '', 'fatherName' => $params['fatherName'] ?? ''],
                self::FINNOTECH_MATCH_MOBILE_NID => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/shahkar/verify', 'mobile' => ($params['mobile'] ?? ''), 'nationalCode' => ($params['nationalCode'] ?? '')],
                self::FINNOTECH_CARD_INFO => [self::FINNOTECH_BASE_URL . '/mpg/v2/clients/' . ($params['clientId'] ?? '') . '/cards/' . ($params['card'] ?? ''), 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_DEPOSITS => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['users'] ?? '') . '/deposits', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SEND_OTP => [self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/authorize', 'client_id' => ($params['client_id'] ?? ''), 'response_type' => $params['response_type'] ?? '', 'redirect_uri' => $params['redirect_uri'] ?? '', 'scope' => $params['scope'] ?? '', 'mobile' => $params['mobile'] ?? '', 'auth_type' => $params['auth_type'] ?? '', 'state' => $params['state'] ?? ''],
                self::FINNOTECH_VERIFY_OTP => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/verify/sms',
                self::FINNOTECH_VERIFY_AC_TOKEN => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/token',
                self::FINNOTECH_BACK_CHEQUES => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/backCheques', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SAYAD_ACCEPT_CHEQUE => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/ac/sayadIssueCheque', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SAYAD_ISSUE_CHEQUE => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/sayadAcceptCheque', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SAYAD_CANCEL_CHEQUE => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/sayadCancelCheque', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/sayadIssuerInquiryCheque', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SAYAD_CHEQUE_INQUIRY => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/sayadChequeInquiry', 'trackId' => $params['track_id'] ?? '', 'sayadId' => $params['sayad_id'] ?? '', 'idCode' => $params['id_code'] ?? '', 'shahabId' => $params['shahab_id'] ?? '', 'idType' => $params['id_type'] ?? ''],
                self::FINNOTECH_DEPOSIT_STATEMENT => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/deposits/' . ($params['deposit'] ?? '') . '/statement', 'trackId' => $params['track_id'] ?? '', 'toDate' => $params['to_date'] ?? '', 'fromDate' => $params['from_date'] ?? '', 'toTime' => $params['to_time'] ?? '', 'fromTime' => $params['from_time'] ?? ''],
                self::FINNOTECH_DEPOSIT_BALANCE => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/deposits/' . ($params['deposit'] ?? '') . '/balance', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_FACILITY_INQUIRY => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/users/' . ($params['user'] ?? '') . '/sms/facilityInquiry', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_IBAN_OWNER_VERIFICATION => [self::FINNOTECH_BASE_URL . '/kyc/v2/clients/' . ($params['clientId'] ?? '') . '/ibanOwnerVerification', 'trackId' => $params['track_id'] ?? '', 'birthDate' => $params['birth_date'] ?? '', 'nationalCode' => $params['national_code'] ?? '', 'iban' => $params['iban'] ?? ''],
                self::IRANIAN_REQUEST => [self::IRANIAN_BASE_URL . '/request' ],
                self::IRANIAN_RE_NEW_TOKEN => [self::IRANIAN_BASE_URL . '/request/' . ($params['code'] ?? '') . '/renewToken'],
                self::IRANIAN_VALIDATE =>[self::IRANIAN_BASE_URL . '/request/'. ($params['code'] ?? '') .'/validate'],
                self::IRANIAN_STATUS => [self::IRANIAN_BASE_URL . '/request/'. ($params['code'] ?? '') .'/status'],
                self::IRANIAN_REGENERATE_REPORT => [self::IRANIAN_BASE_URL . '/request/'. ($params['code'] ?? '') .'/ReGenerateReport'],
                self::IRANIAN_REPORT_XML => [self::IRANIAN_BASE_URL . '/report/'. ($params['reportCode'] ?? '').'/xml'],
                self::IRANIAN_REPORT_PDF => [self::IRANIAN_BASE_URL . '/request/ '.($params['reportCode'] ?? '').'/pdfReport'],
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

    public static function getUrl($service, $params = null)
    {
        return self::itemAlias('ServiceUrl', $service, $params);
    }

}


