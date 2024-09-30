
# مستندات API اعتبارسنجی ایرانیان

این پکیج برای ارتباط با سامانه اعتبارسنجی ایرانیان طراحی شده است و شامل مجموعه‌ای از API‌ها برای دریافت و مدیریت توکن‌ها، ارسال درخواست‌های اعتبارسنجی و دریافت گزارش‌های مربوطه است.

## 1. دریافت توکن (Token)
ابتدا باید یک توکن دسترسی برای استفاده از سایر API‌ها دریافت کنید. این توکن باید در هدر درخواست‌ها استفاده شود.

### روش فراخوانی:
- **آدرس**: `BaseOpenBanking::IRANIAN_GET_TOKEN`
- **متد**: `POST`

### پارامترهای خروجی
| پارامتر          | نوع      | توضیحات                                  |
|------------------|----------|------------------------------------------|
| AccessToken      | string   | توکن دسترسی که برای استفاده از سایر APIها مورد نیاز است |

```php
  Yii::\$app->openBanking->call(BaseOpenBanking::PLATFORM_IRANIAN, BaseOpenBanking::IRANIAN_GET_TOKEN, []);
```

## 2. تجدید توکن (Refresh Token)
در صورتی که توکن منقضی شده باشد، باید از این متد برای تجدید آن استفاده کنید.

### روش فراخوانی:
- **آدرس**: `BaseOpenBanking::IRANIAN_REFRESH_TOKEN`
- **متد**: `POST`

### پارامترهای خروجی
| پارامتر          | نوع      | توضیحات                                  |
|------------------|----------|------------------------------------------|
| AccessToken      | string   | توکن جدید                                |

```php
  Yii::\$app->openBanking->call(BaseOpenBanking::PLATFORM_IRANIAN, BaseOpenBanking::IRANIAN_REFRESH_TOKEN, []);
```

## 3. ارسال درخواست اعتبارسنجی
برای ارسال اطلاعات فرد (شامل کد ملی و شماره موبایل) به منظور انجام اعتبارسنجی از این متد استفاده می‌شود.

### روش فراخوانی:
- **آدرس**: `BaseOpenBanking::IRANIAN_REQUEST`
- **متد**: `POST`

### پارامترهای ورودی
| پارامتر                 | نوع      | توضیحات          |
|-------------------------|----------|------------------|
| RealPersonNationalCode   | string   | کد ملی فرد       |
| MobileNumber             | string   | شماره موبایل فرد |

### پارامترهای خروجی
| پارامتر          | نوع      | توضیحات                                  |
|------------------|----------|------------------------------------------|
| Data             | JSON     | داده‌های اعتبارسنجی                     |
| HasError         | boolean  | وضعیت درخواست                           |
| Messages         | Array    | پیام‌های مرتبط با خطاها یا هشدارها       |

```php
     Yii::\$app->openBanking->call(BaseOpenBanking::PLATFORM_IRANIAN, BaseOpenBanking::IRANIAN_REQUEST, [
        'RealPersonNationalCode' => '',
        'MobileNumber' => ''
    ]);
```

## 4. اعتبارسنجی توکن
این متد برای بررسی صحت توکن و کد هش ارسال‌شده استفاده می‌شود.

### روش فراخوانی:
- **آدرس**: `BaseOpenBanking::IRANIAN_VALIDATE`
- **متد**: `POST`

### پارامترهای ورودی
| پارامتر     | نوع      | توضیحات            |
|-------------|----------|--------------------|
| Token       | string   | توکن برای اعتبارسنجی |
| hash_code   | string   | کد هش معتبر         |

### پارامترهای خروجی
| پارامتر          | نوع      | توضیحات                                  |
|------------------|----------|------------------------------------------|
| Data             | JSON     | نتیجه اعتبارسنجی                        |
| HasError         | boolean  | وضعیت درخواست                           |
| Messages         | Array    | پیام‌های مرتبط با خطاها یا هشدارها       |

```php
   Yii::\$app->openBanking->call(BaseOpenBanking::PLATFORM_IRANIAN, BaseOpenBanking::IRANIAN_VALIDATE, [
        'Token' => '',
        'hash_code' => ''
    ]);
```

## 5. وضعیت تراکنش
این متد برای بررسی وضعیت یک تراکنش ایرانی بر اساس کد هش ارسال‌شده استفاده می‌شود.

### روش فراخوانی:
- **آدرس**: `BaseOpenBanking::IRANIAN_STATUS`
- **متد**: `POST`

### پارامترهای ورودی
| پارامتر     | نوع      | توضیحات            |
|-------------|----------|--------------------|
| hash_code   | string   | کد هش معتبر برای بررسی وضعیت تراکنش |

### پارامترهای خروجی
````| پارامتر                | نوع      | توضیحات                                  |
|------------------------|----------|------------------------------------------|
| success                | boolean  | موفقیت‌آمیز بودن درخواست                 |
| status                 | int      | کد وضعیت درخواست                         |
| data                   | object   | شامل اطلاعات وضعیت تراکنش                |
| data.statusTitle       | string   | عنوان وضعیت تراکنش                       |
| data.status            | string   | کد وضعیت تراکنش                          |
| data.reportLink        | string   | لینک گزارش تراکنش                        |
| data.otpMessageStatus  | int      | وضعیت پیام OTP                           |
| data.otpMessageStatusTitle | string | عنوان وضعیت پیام OTP                     |
| data.reportTryCount    | int      | تعداد دفعات تلاش برای گزارش              |
| hasError               | boolean  | آیا خطایی در درخواست وجود دارد یا خیر   |
| messages               | array    | پیام‌های مرتبط با خطاها یا هشدارها       |

```php
public function actionTestIranianStatus()
{
     Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_IRANIAN, BaseOpenBanking::IRANIAN_STATUS, [
        'hash_code' => $this->hash_code
    ]);
}
```
5. وضعیت‌ها
Status: وضعیت درخواست
OTPSentStatusTitle: ارسال درخواست توکن
OTPLocked: دریافت مجدد توکن قفل شده است
OTPAccepted: توکن پذیرفته شد
OTPCheckFailed: توکن اشتباه است
NotMatchingRealPersonNationalCodeAndMobileNumber: عدم تطابق شماره ملی و شماره همراه
NotMatchingRealPersonAndLegalPerson: عدم تطابق شماره ملی و شناسه ملی
IdentityCheckAccepted: احراز هویت انجام شد
ReportGenerated: ساخت گزارش انجام شده است
ReportGeneratedButDataLost: گزارش ساخته شده ولی داده از دست رفته است
ReportGenerationFailed: ساخت گزارش با خطا مواجه شد
RequestExpired: اعتبار درخواست به پایان رسیده است
6. وضعیت پیامک‌ها
ReportUrlMessageStatus / OTPMessageStatus
2: اطلاعات دقیقی یافت نشده
3: به مخابرات رسیده
4: به گوشی رسیده
5: به گوشی نرسیده
مخابراتی سیاه لیست """

````