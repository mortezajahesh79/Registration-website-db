# DeutschClassWeb - فرم ثبت‌نام کلاس آلمانی A1

فرم ثبت‌نام مشابه Google Forms با ذخیره‌سازی در MySQL و چک تکراری ایمیل.
http://brightfuturela.de
این وبسایتمونه


## راه‌اندازی پروژه

1. پروژه را در فولدر `www` سرور لوکال (Laragon/XAMPP) کپی کنید.
2. MySQL را اجرا کنید.
3. در phpMyAdmin دیتابیس `deutsch_class_web` بسازید.
4. محتوای `database.sql` را اجرا کنید.
5. فایل `config.php` را چک کنید (معمولاً نیازی به تغییر نیست).
6. به آدرس `http://deutschClassWeb.test/` بروید.

## فایل‌ها

- index.php: فرم اصلی
- process.php: پردازش و ذخیره داده
- style.css: استایل مشابه Google Forms
- script.js: validation و تعاملات
- config.php: اتصال دیتابیس
- database.sql: ساختار جدول

## ویژگی‌ها

- ریسپانسیو و RTL
- چک تکراری ایمیل
- امنیت پایه (PDO, sanitize)
- validation کلاینت و سرور

