How To Use Faraboom Services
-------------
add to your code:

```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA,data[])
```
Available Faraboom Services:
-------------

depositToShaba(تبدیل شماره حساب به شماره شبا)
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA</td>
    <td>سرویس تبدیل شماره سپرده به شبا</td>
  </tr>
  <tr>
    <th rowspan="6">data</th>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*deposit_number</td>
    <td>شماره سپرده</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA,['deposit_number' => your deposit number])
```

shabaToDeposit
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_SHABA_TO_DEPOSIT</th>
 <th>سرویس تبدیل شماره شبا به شماره سپرده</th>

  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*iban</td>
    <td>شماره شبا</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_SHABA_TO_DEPOSIT,['iban' => your iban])
```

matchNationalCodeAccount
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT</th>
 <th>سرویس انطباق کدملی و حساب</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
<tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*national_code</td>
 <td>شماره ملی</td>
  </tr>
 <tr>
    <td>*account</td>
 <td>شماره حساب</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT,['national_code' => '' , 'account' => ''])
```

depositHolder:
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
<th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_DEPOSIT_HOLDER</th>
 <th>سرویس دریافت نام صاحب سپرده</th>
  </tr>
  <tr>
    <td rowspan="6">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*deposit_number</td>
    <td>شماره سپرده</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_DEPOSIT_HOLDER,['deposit_number' => your deposit number])
```

paya
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_PAYA</th>
    <th>انتقال وجه بین بانکی پایا</th>
  </tr>
  <tr>
    <td rowspan="16">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>*iban_number</td>
    <td>شماره شبا مقصد</td>
  </tr>
  <tr>
    <td>*owner_name</td>
    <td>نام صاحب سپرده</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>description</td>
    <td>توضیحات</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور</td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
    <td>توضیحات اضافه</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td></td>
  </tr>
 <tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_PAYA,[
'source_deposit_number' => '',
'amount' => 10000,
'owner_name' => '',
'iban_number' => '',
])
```

batchPaya
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_BATCH_PAYA</th>
    <th>انتقال وجه پایا گروهی</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*transactions</td>
    <td>آرایه ای از مبالغ انتقال. حداقل باید شامل دو آیتم باشد:
    <table>
        <tr>
            <th>نام فیلد</th>
            <th>توضیحات</th>
        </tr>
        <tr>
            <td>*amount</td>
            <td>مبلغ (حداقل ۵۰۰۰۰۰۰۰۰) </td>
        </tr>
        <tr>
            <td>*receiver_name</td>
            <td>نام گیرنده</td>
        </tr>
        <tr>
            <td>*receiver_family</td>
            <td>نام خانوادگی</td>
        </tr>
        <tr>
            <td>*iban</td>
            <td>شماره شبا گیرنده</td>
        </tr>
        <tr>
            <td>receiver_phone_number</td>
            <td>شماره تلفن گیرنده</td>
        </tr>
        <tr>
            <td>factor_number</td>
            <td>شماره فاکتور </td>
        </tr>
    </table>
</td>
  </tr>
<tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>توضیحات انتقال</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>ignore_error</td>
    <td></td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
    <td>توضیحات اضافه</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_BATCH_PAYA,[
'source_deposit_number' => '',
'transactions' => [
    [
        'amount' => 10000,
        'receiver_name' => '',
        'receiver_family' => '',
        'iban' => '',
    ]
]
])
```

internalTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_INTERNAL_TRANSFER</th>
    <th>سرویس انتقال وجه داخلی</th>
  </tr>
  <tr>
    <td rowspan="15">data</td>
  </tr>
 <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*source_deposit</td>
    <td>سپرده مبدا</td>
  </tr>
<tr>
    <td>*destination_deposit</td>
    <td>شماره سپرده مقصد</td>
  </tr>
<tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>source_comment</td>
    <td>شرحی توسط انتقال دهنده وجه وارد می شود</td>
  </tr>
<tr>
    <td>destination_comment</td>
    <td>شرحی که پس از انتقال وجه ، توسط شخصی که دریافت کننده وجه است قابل رویت است</td>
  </tr>
<tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
<tr>
    <td>reference_number</td>
    <td>شماره پیگیری</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
    <td>در سند خود قرار می دهند third party شرحی که کاربران</td>
  </tr>
<tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

batchInternalTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_BATCH_INTERNAL_TRANSFER</th>
    <th>انتقال وجه دسته ای</th>
  </tr>
  <tr>
    <td rowspan="13">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
<tr>
    <td>*destination_batch_transfers</td>
    <td>
        <table>
        <tr>
            <td>destination_deposit_number</td>
            <td>شماره حساب مقصد</td>
        </tr>
        <tr>
            <td>amount</td>
            <td>حداقل مقدار 1.00</td>
        </tr>
   <tr>
            <td>description</td>
            <td>توضیحات</td>
        </tr>
   <tr>
            <td>pay_id</td>
            <td>شناسه پرداخت</td>
        </tr>
        </table>
    </td>
  </tr>
<tr>
    <td>*ignore_error</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>source_description</td>
    <td>یادداشت مربوط به سپرده مبدا</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
    <td>در سند قرار می گیرد third party شرحی که توسط کاربران</td>
  </tr>
<tr>
    <td>signers</td>
  </tr>
<tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

satna
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_SATNA</th>
    <th>انتقال وجه ساتنا</th>
  </tr>
  <tr>
    <td rowspan="16">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>حداقل مقدار =150000000.00</td>
  </tr>
<tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
<tr>
    <td>*receiver_name</td>
    <td>نام دریافت کننده</td>
  </tr>
<tr>
    <td>*receiver_family</td>
    <td>نام خانوداگی دریافت کننده</td>
  </tr>
<tr>
    <td>*destination_iban_number</td>
    <td>شبای مقصد</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>receiver_phone_number</td>
    <td>شماره تلفن دریافت کننده</td>
  </tr>
<tr>
    <td>factor_number</td>
    <td>شماره فاکتور</td>
  </tr>
<tr>
    <td>description</td>
    <td>توضیحات</td>
  </tr>
<tr>
    <td>tranaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
<tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
</table>

checkinquiryReceiver
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_CHECK_INQUIRY_RECEIVER</th>
    <th>استعلام چک توسط گیرنده</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*sayad_id</td>
    <td>نام شخص
حداقل طول = 16
حداکثر طول = 2147483647
</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
</table>

shabainquiry
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_SHABA_INQUIRY</th>
    <th>استعلام شماره شبا</th>
  </tr>
  <tr>
    <td rowspan="6">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*iban</td>
    <td>مقدار شماره شبا</td>
  </tr>
</table>

matchNationalCodeMobile
-------------
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_MOBILE</th>
    <th>تطبیق کد ملی و شماره موبایل</th>
  </tr>
  <tr>
    <td rowspan="7">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>*national_code</td>
    <td>شماره ملی</td>
  </tr>
  <tr>
    <td>*mobile</td>
    <td>موبایل</td>
  </tr>
</table>

cartToShaba
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_CART_TO_SHABA</td>
    <td>شماره کارت به شبا</td>
  </tr>
  <tr>
    <td rowspan="4">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>pan</td>
    <td>شماره کارت</td>
  </tr>
</table>

reportPayaTransactions
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSACTIONS</td>
    <td>سرویس گزارش لیست تراکنش های انتقال وجه پایا</td>
  </tr>
  <tr>
    <td rowspan="22">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>source_deposit_iban</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>شماره اولین رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>length</td>
    <td>تعداد رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>reference_id</td>
    <td>شماره پیگیری انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>traco_no</td>
    <td>کد یکتا برای پیگیری</td>
  </tr>
 <tr>
    <td>transaction_id</td>
    <td>شماره پیگیری تراکنش</td>
  </tr>
 <tr>
    <td>from_register_date</td>
    <td>از تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_register_date</td>
    <td>تا تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_issue_date</td>
    <td>از تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>To_issue_date</td>
    <td>تا تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_transaction_amount</td>
    <td>حداقل مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_transaction_amount</td>
    <td>حداکثر مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>iban_number</td>
    <td>آی بن شماره سپرده مقصد</td>
  </tr>
 <tr>
    <td>iban_owner_name</td>
    <td>نام صاحب سپرده مقصد</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>description</td>
    <td>شرح انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>include_transaction_status</td>
    <td>[READY_FOR_PROCESS, SUSPENDED, CANCELED, PROCESS_FAIL, READY_TO_TRANSFER, TRANSFERRED, SETTLED, NOT_SETTLED, REJECTED, UNKNOWN]</td>
  </tr>
</table>

reportPayaTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSFER</td>
    <td>سرویس گزارش لیست انتقال وجه های پایا</td>
  </tr>
  <tr>
    <td rowspan="22">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>source_deposit_iban</td>
    <td>شماره شبای سپرده مبدأ</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>شماره اولین رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>length</td>
    <td>تعداد رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>from_transaction_amount</td>
    <td>حداقل مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_transaction_amount</td>
    <td>حداکثر مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>reference_id</td>
    <td>شماره پیگیری انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>trace_no</td>
    <td> شماره پیگیری تراکنش</td>
  </tr>
 <tr>
    <td>destination_iban_number</td>
    <td>شماره آی بن مقصد را برمی گرداند</td>
  </tr>
 <tr>
    <td>destination_owner_name</td>
    <td>نام صاحب سپرده مقصد را برمی گرداند</td>
  </tr>
 <tr>
    <td>from_register_date</td>
    <td>از تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_register_date</td>
    <td>تا تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_issue_date</td>
    <td>از تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_issue_date</td>
    <td>تا تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>description</td>
    <td>شرح انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>status_set</td>
    <td>لیستی از وضعیت هایی انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>transaction_status_set</td>
    <td>لیستی از وضعیت تراکنش های انتقال وجه پایا</td>
  </tr>
</table>

cancelPaya
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_CANCLE_PAYA</td>
    <td>لغو انتقال وجه پایا</td>
  </tr>
  <tr>
    <td rowspan="6">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>transfer_id</td>
    <td>شماره پیگیری که در پاسخ سرویس انتقال وجه پایا برگردانده شد</td>
  </tr>
 <tr>
    <td>comment</td>
    <td>یادداشت</td>
  </tr>
</table>

reportSatnaTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_REPORT_SATNA_TRANSFER</td>
    <td>گزارش انتقال وجه ساتنا</td>
  </tr>
  <tr>
    <td rowspan="13">data</td>
  </tr>
  <tr>
    <td>*slave_id</td>
    <td>شناسه کسب و کار</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره یکتا پیگیری</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>status</td>
    <td>وضعیت انتقال وجه</td>
  </tr>
 <tr>
    <td>branch_code</td>
    <td>کد شعبه</td>
  </tr>
 <tr>
    <td>branch_name</td>
    <td>نام شعبه</td>
  </tr>
 <tr>
    <td>from_date</td>
    <td>از تاریخ</td>
  </tr>
 <tr>
    <td>length</td>
    <td>long تعداد رکورد بازگشتی از نوع</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>long اولین رکورد بازگشتی از نوع</td>
  </tr>
 <tr>
    <td>serial</td>
    <td>شماره سریال</td>
  </tr>
 <tr>
    <td>trace_no</td>
    <td>شماره پیگیری ارسال شده از برنامه</td>
  </tr>
 <tr>
    <td>to_date</td>
    <td>تا تاریخ</td>
  </tr>
</table>

-------------

batchSatna
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_BATCH_SATNA</td>
    <td>انتقال وجه ساتنا گروهی</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>توضیحات</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
 <tr>
    <td>signers</td>
    <td></td>
  </tr>
 <tr>
    <td>transactions</td>
    <td></td>
  </tr>
</table>

-------------



Advanced config
-------------

- [Installation Guide](./src/guide/README.md)