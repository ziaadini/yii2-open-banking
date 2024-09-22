How To Use Faraboom Services
-------------
add to your code:

```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_TRANSFER['track_id' => your track id])
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
    <td>BaseOpenBanking::PLATFORM_FINNOTECH</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FINNOTECH_TRANSFER</td>
    <td>سرویس انتقال وجه</td>
  </tr>
  <tr>
    <th rowspan="14">data</th>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح انتقال وجه</td>
  </tr>
  <tr>
    <td>*destination_firstname</td>
    <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destination_lastname</td>
    <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destination_number</td>
    <td>شماره حساب مقصد</td>
  </tr>
 <tr>
    <td>*payment_number</td>
    <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*reason_description</td>
    <td>بابت</td>
  </tr>
 <tr>
    <td>*deposit</td>
    <td>شماره حساب مبدا</td>
  </tr>
 <tr>
    <td>*source_firstname</td>
    <td>نام صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*source_lastname</td>
    <td>نام خانوادگی صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*second_password</td>
    <td>رمز انتقال وجه</td>
  </tr>
 <tr>
    <td>*merchant_name</td>
    <td>نام پذیرنده</td>
  </tr>
 <tr>
    <td>*merchant_iban</td>
    <td>شماره شبا پذیرنده</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_PAYA_TRANSAFER,['track_id' => your track id])
```
<br />

payaTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_PAYA_TRANSFER</th>
 <th>سرویس پرداخت واریز پایا</th>

  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*destination_number</td>
    <td>شماره شبای بانک مقصد</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح انتقال وجه</td>
  </tr>
 <tr>
    <td>*reason_description</td>
    <td>اطلاعات بیشتر</td>
  </tr>
 <tr>
    <td>*payment_number</td>
    <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*destination_firstname</td>
    <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destination_lastname</td>
    <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*customer_ref</td>
    <td>شناسه ارجاع</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER,['track_id' => your track id])
```
<br />

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
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER</th>
 <th>دستور پرداخت واریز داخلی</th>
  </tr>
  <tr>
    <td rowspan="13">data</td>
  </tr>
<tr>
    <td>*amount</td>
    <td>مبلغ تراکنش</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح تراکنش</td>
  </tr>
  <tr>
    <td>*destination_number</td>
 <td>شماره شبا مقصد</td>
  </tr>
 <tr>
    <td>*payment_number</td>
 <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*customer_ref</td>
 <td>شماره مرجع تراکنش که توسط کاربر وارد می شود</td>
  </tr>
 <tr>
    <td>*source_firstname</td>
 <td>نام صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*source_lastname</td>
 <td>نام خانوادگی صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*reason_description</td>
 <td>دلیل تراکنش</td>
  </tr>
 <tr>
    <td>*note</td>
 <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>destination_firstname</td>
 <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>destination_lastname</td>
 <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>deposit</td>
 <td>شماره حساب مبدا</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SHABA_INQUIRY,['track_id' => your track id])
```
<br />

shabaInquiry:
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
<th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SHABA_INQUIRY</th>
 <th>اطلاعات شماره شبا</th>
  </tr>
  <tr>
    <td rowspan="3">data</td>
  </tr>
  <tr>
    <td>*iban</td>
    <td>شماره شبا</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>شماره پیگیری</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA,['track_id' => your track id,'deposit' =>your deposit,'bank_code' => your bank code])
```
<br />

depositToShaba
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA</th>
    <th>تبدیل شماره حساب به شبا</th>
  </tr>
  <tr>
    <td rowspan="6">data</td>
  </tr>
  <tr>
    <td>*deposit</td>
    <td>شماره حسابی که قصد دریافت شماره شبا آن را دارید</td>
  </tr>
  <tr>
    <td>*bank_code</td>
    <td>کد بانک صاحب حساب</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CHECK_INQUIRY,[
    'track_id' => your track id,
    'sayad_id' =>your sayad id
])
```
<br />

checkInquiry
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
    <th>BaseOpenBanking::FARABOOM_CHECK_INQUIRY</th>
    <th>استعلام شناسه چک صیادی</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*sayad_id</td>
    <td>شناسه صیاد چک</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_BANKS_INFO,[
    'track_id' => your track id
])
```
<br />

banksInfo
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_BANKS_INFO</th>
    <th>سرویس اطلاعات بانک</th>
  </tr>
  <tr>
    <td rowspan="15">data</td>
  </tr>

</table>


Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT,[
    'track_id' => your track id,
    'card' => your card
])
```
<br />

cardToDeposit
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT</th>
    <th>تبدیل شماره کارت به شماره حساب</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td>رشته ای اختیاری با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
  </tr>
  <tr>
    <td>*card</td>
    <td>شماره کارت</td>
  </tr>

</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_TO_SHABA,[
    'track_id' => your track id,
    'card' => your card,
    'version' => your version
])
```
<br />

cardToShaba
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_TO_SHABA</th>
    <th>تبدیل شماره کارت به شبا</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> رشته ای اختیاری با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
  </tr>
  <tr>
    <td>*card</td>
    <td>شماره کارت</td>
  </tr>
 <tr>
    <td>*version</td>
    <td>ورژن API که باید برابر عدد دو باشد</td>
</tr>
</table>



Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_NID_VERIFICATION,[
    'track_id' => your track id,
    'birth_date' => your birthDate,
    'users' => your users,
    'full_name' => your fullName,
    'first_name' => your firstName,
    'last_name' => your lastName,
    'father_name' => your fatherName,
    'gender' => your gender
])
```
<br />

nidVerification
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_NID_VERIFICATION</th>
    <th>احراز هویت با کد ملی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
  <tr>
    <td>*users</td>
    <td>کد ملی که میخواهید صحت آن را بررسی کنید و اجباری است</td>
  </tr>
 <tr>
    <td>*birth_date</td>
    <td> تاریخ تولد صاحب این کد ملی </td>
</tr>
 <tr>
    <td>*full_name</td>
    <td> نام و نام خانوادگی که میخواهید صحت آن را بررسی کنید </td>
</tr>
 <tr>
    <td>*first_name</td>
    <td> نام کوچک صاحب کد ملی </td>
</tr>
 <tr>
    <td>*last_name</td>
    <td> نام خانوادگی صاحب کد ملی </td>
</tr>
 <tr>
    <td>*father_name</td>
    <td> نام پدر صاحب کد ملی </td>
</tr>
 <tr>
    <td>*gender</td>
    <td> جنسیت صاحب کد ملی که یکی از دو مقدار زن یا مرد است </td>
</tr>

</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID,[
    'track_id' => your track id,
    'mobile' => your mobile,
    'nationalCode' => your nationalCode
])
```
<br />

matchMobileNid
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID</th>
    <th>تطبیق کد ملی و شماره موبایل</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
  </tr>
  <tr>
    <td>*mobile</td>
    <td>شماره موبایل</td>
  </tr>
 <tr>
    <td>*national_code</td>
    <td>کدملی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_INFO,[
    'track_id' => your track id,
    'card' => your card
])
```
<br />

cardInfo
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_INFO</th>
    <th>استعلام کارت</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td>کد پیگیری</td>
</tr>
 <tr>
    <td>*card</td>
    <td>شماره کارت ۱۶ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSITS,[
    'track_id' => your track id,
    'card' => your card
])
```
<br />

deposits
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSITS</th>
    <th>اعلام شماره حساب با دریافت کد ملی</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*users</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
 <tr>
    <td>track_id</td>
    <td>رشته ای با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_BACK_CHEQUES,[
    'track_id' => your track id,
    'user' => your user,
    'code' => '',
    'redirect_uri' => '',
])
```
<br />

backCheques
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_BACK_CHEQUES</th>
    <th>استعلام پیامکی چک برگشتی</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE,[
    'track_id' => your track id,
    'user' => your user
])
```
<br />

sayadAcceptCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE</th>
    <th>تایید چک صیاد توسط گیرنده</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله verify</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس برگشتی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE,[
    'track_id' => your track id,
    'user' => your user,
    'code' => 'کد دریافتی در مرحله وریفای',
    'redirect_uri' => ''
])
```
<br />

sayadCancelCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE</th>
    <th>لغو چک صیاد</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله verify</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس برگشتی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE,[
    'track_id' => your track id,
    'user' => your user
    'code' => ''
    'redirect_uri' => ''
])
```
<br />

sayadIssuerInquiryCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE</th>
    <th>استعلام چک صیاد توسط صادرکننده</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله verify</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس برگشتی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_CHEQUE_INQUIRY,[
    'track_id' => your track id,
    'user' => your user,
    'code' => ''
    'redirect_uri' => ''
    'id_code' => your id code,
    'shahab_id' => your shahab id,
    'id_type' => your id type,
    'sayad_id' => your sayad id
])
```
<br />

sayadChequeInquiry
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_CHEQUEـINQUIRY</th>
    <th>استعلام چک صیاد</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله verify</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس برگشتی</td>
</tr>
<tr>
    <td>id_code</td>
    <td>کد شناسایی</td>
</tr>
<tr>
    <td>shahab_id</td>
    <td>کد شهاب</td>
</tr>
<tr>
    <td>*id_type</td>
    <td>نوع کد شناسایی با ملاحظات: مشتری حقیقی ۱,مشتری حقوقی ۲</td>
</tr>
<tr>
    <td>*sayad_id</td>
    <td>شناسه صیاد چک</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE,[
    'track_id' => your track id,
    'user' => your user,
    'code' => ''
    'redirect_uri' => ''
    'id_code' => کدشناسایی,
    'shahab_id' => کدشهاب,
    'sayad_id' => شناسه صیاد,
])
```
<br />

backCheques
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_BACK_CHEQUES</th>
    <th>استعلام چک برگشتی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله احراز هویت</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس بازگشتی کلاینت، دامنه این آدرس باید با دامنه ثبت شده به ازای آدرس بازگشتی کلاینت در فینوتک برابر باشد</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_BACK_CHEQUES,[
    'track_id' => your track id,
    'user' => '',
    'code' => '',
    'redirect_uri' => '',
])
```
<br />


depositStatement
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSIT_STATEMENT</th>
    <th>دریافت گردش حساب</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*deposit</td>
    <td>شماره حساب</td>
</tr>
<tr>
    <td>to_date</td>
    <td>فرمت تاریخ باید به صورت YYYYMMDD باشد . لازم به ذکر است بازه زمانی گردش حساب بیشتر از ۳۱ روز نمی تواند باشد و در صورت وارد کردن تاریخ شروع اعلام تاریخ پایان الزامی می باشد</td>
</tr>
<tr>
    <td>from_date</td>
    <td>فرمت تاریخ باید به صورت YYYYMMDD باشد اختیاری</td>
</tr>
<tr>
    <td>to_time</td>
    <td>فرمت زمان باید به صورت HHMMSS باشد اختیاری</td>
</tr>
<tr>
    <td>from_time</td>
    <td>زمان باید به صورت HHMMSS باشد اختیاری</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSIT_STATEMENT,[
    'track_id' => your track id,
    'deposit' => '',
    'to_date' => '',
    'from_date' => '',
    'to_time' => '',
    'from_time' => '',
])
```

<br>


sendOtpAuthorizeCode
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SEND_OTP</th>
    <th>درخواست احراز هویت پیامکی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*scopes</td>
    <td>اسکوپ (دسترسی)هایی که کاربر باید مجوز دسترسی به آن‌ها را بدهد به صورت جدا شونده با کاما انگلیسی (comma separated) وارد شوند . تنها اسکوپ هایی که تایپ توکن ان ها از نوع sms هست در این جا می توانید استفاده کنید.</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس بازگشتی کلاینت، دامنه این آدرس باید با دامنه ثبت شده به ازای آدرس بازگشتی کلاینت در فینوتک برابر باشد</td>
</tr>
<tr>
    <td>*mobile</td>
    <td>شماره موبایلی که کد احراز هویت به منظور تایید دسترسی برای سرویس مورد نظر به آن ارسال خواهد شد</td>
</tr>
<tr>
    <td>state</td>
    <td>(اختیاری) این کد برای ردگیری درخواست توسط کلاینت استفاده می‌شود و در صورت ارسال به همراه کد به آدرس بازگشتی کلاینت برگردانده می‌شود</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SEND_OTP,[
'track_id' => your track id,
'scopes' => '',
'redirect_uri' => 'https://..........',
'mobile' => '09123456789',
'state' => ''
])
```
<br />


verifyOtpCode
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SEND_OTP</th>
    <th>درخواست احراز هویت پیامکی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td>trackId دریافتی در مرحله ارسال کد پیامکی</td>
</tr>
<tr>
    <td>*otp</td>
    <td>کد پیامکی</td>
</tr>
<tr>
    <td>*mobile</td>
    <td>شماره موبایل</td>
</tr>
<tr>
    <td>*national_code</td>
    <td>کدملی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_VERIFY_OTP,[
'track_id' => your track id,
'otp' => '',
'mobile' => 'https://..........',
'national_code' => '09123456789',
])
```

<br>

depositBalance
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSIT_BALANCE</th>
    <th>موجودی حساب</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*deposit</td>
    <td>شماره حساب معتبر</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSIT_BALANCE,[
'track_id' => your track id,
'clientId' => your client id,
'deposit' => your deposit,

])
```

<br>


facilityInquiry
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_FACILITY_INQUIRY</th>
    <th>استعلام پیامکی تسهیلات</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*code</td>
    <td>کد دریافتی در مرحله verify</td>
</tr>
<tr>
    <td>*redirect_uri</td>
    <td>آدرس برگشتی</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی کاربر</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_FACILITY_INQUIRY,[
'track_id' => your track id,
'user' => your user,
'code' => کد مرحله verify,
'redirect_uri' => آدرس برگشتی,

])
```

<br>


ibanOwnerVerification
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_IBAN_OWNER_VERIFICATION</th>
    <th>تطبیق شماره شبا و کدملی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
 <tr>
    <td>*track_id</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*birthDate</td>
    <td> تاریخ تولد شمسی صاحب حساب</td>
</tr>
<tr>
    <td>*national_code</td>
    <td> کد ملی صاحب حساب</td>
</tr>
<tr>
    <td>*iban</td>
    <td>شماره شبا</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_IBAN_OWNER_VERIFICATION,[
    'track_id' => your track id,
    'birth_date' => your birth_date,
    'national_code' => your national_code,
    'iban' => your iban,

])
```


Advanced config
-------------

- [Installation Guide](./src/guide/README.md)