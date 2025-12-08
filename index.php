<?php
// index.php
// اگر بعداً بخوایم پیام موفقیت یا خطا نشون بدیم، از query string استفاده می‌کنیم
$status = $_GET['status'] ?? '';
$message = '';

if ($status === 'success') {
    $message = '<div class="success-message">ثبت‌نام موفق! لینک گروه به ایمیل شما ارسال خواهد شد.</div>';
} elseif ($status === 'email_exists') {
    $message = '<div class="error-message">این ایمیل قبلاً ثبت شده است!</div>';
} elseif ($status === 'error') {
    $message = '<div class="error-message">خطایی رخ داد. لطفاً مجدداً تلاش کنید.</div>';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت‌نام کلاس سطح A1 آلمانی</title>
    
    <!-- فونت فارسی گوگل (Vazirmatn - خیلی تمیز و شبیه Google Forms) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="form-header">
            <h1>فرم ثبت‌نام کلاس</h1>
            <p class="description">
                لطفاً اطلاعات خود را دقیق وارد کنید تا لینک کلاس برای شما ارسال شود. ظرفیت هر کلاس محدود به ۱۰ نفر است.
            </p>
        </header>

<?php if ($status === 'success'): ?>
    <div class="success-box">
        <h2>فرم ثبت‌نام کلاس سطح A1</h2>
        <div class="success-content">
            <p>ثبت‌نام شما با موفقیت انجام شد!</p>
            <p>لینک گروه تلگرامی کلاس به زودی به تلگرام شما ارسال می‌شود.</p>
            <p>لطفاً برای اطلاع از زمان کلاس‌ها و لینک ثبت نام کلاس‌ها به کانال تلگرام ما مراجعه کنید.</p>
            
            <div class="link-box">
                <a href="https://t.me/BrightFutureLAG" target="_blank">https://t.me/BrightFutureLAG</a>
            </div>
            
            <p>برای شرکت در کلاس ها و دریافت کردن لینک گوگل میت حتما به گروه زیر بپیوندید.</p>
            
            <div class="link-box">
                <a href="https://t.me/BrightFutureLAG" target="_blank">https://t.me/BrightFutureLAG</a>
            </div>
            
            <p>و برای دیدن منابع ویدیویی ما لطفاً کانال یوتیوب ما رو هم سابسکرایب کنید.</p>
            
            <div class="link-box">
                <a href="https://www.youtube.com/@BrightFutureLAG" target="_blank">https://www.youtube.com/@BrightFutureLAG</a>
            </div>
            
            <p><strong>منتظر شما در کلاس‌های آنلاین هستیم 🌟</strong></p>
        </div>
    </div>

<?php elseif ($status === 'email_exists'): ?>
    <div class="error-message">این ایمیل قبلاً ثبت شده است!</div>
<?php elseif ($status === 'error'): ?>
    <div class="error-message">خطایی رخ داد. لطفاً مجدداً تلاش کنید.</div>
<?php endif; ?>

        <form id="registrationForm" action="process.php" method="POST" novalidate>
            <!-- 1. ایمیل -->
            <div class="field-group required">
                <label for="email">ایمیل</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- 2. نام و نام خانوادگی -->
            <div class="field-group required">
                <label for="full_name">نام و نام خانوادگی</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>

            <!-- 3. شماره تماس (اختیاری) -->
            <div class="field-group">
                <label for="phone">شماره تماس (اختیاری)</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <!-- 4. تلگرام ایدی -->
            <div class="field-group required">
                <label for="telegram_id">تلگرام ایدی</label>
                <input type="text" id="telegram_id" name="telegram_id" required>
            </div>

            <!-- 5. ملیت / اصالت -->
            <div class="field-group required">
                <label for="nationality">ملیت / اصالت</label>
                <input type="text" id="nationality" name="nationality" required>
            </div>

            <!-- 6. کشور سکونت -->
            <div class="field-group required">
                <label for="country">کشور سکونت</label>
                <input type="text" id="country" name="country" required>
            </div>

            <!-- 7. سطح آلمانی -->
            <div class="field-group required">
                <label>تا چه سطحی زبان آلمانی را خوانده اید؟</label>
                <div class="radio-group">
                    <label><input type="radio" name="german_level" value="نوآموز بدون شناخت قبلی" required> نوآموز بدون شناخت قبلی</label>
                    <label><input type="radio" name="german_level" value="آشنایی با الفبا"> آشنایی با الفبا</label>
                    <label><input type="radio" name="german_level" value="A1"> A1</label>
                    <label><input type="radio" name="german_level" value="A2"> A2</label>
                    <label><input type="radio" name="german_level" value="B1"> B1</label>
                    <label><input type="radio" name="german_level" value="B2"> B2</label>
                    <label><input type="radio" name="german_level" value="other"> سایر (لطفاً مشخص کنید)</label>
                </div>
                <div id="german_level_other" class="other-field" style="display:none; margin-top:10px;">
                    <input type="text" name="german_level_other" placeholder="سطح خود را بنویسید">
                </div>
            </div>
            <div class="field-group required">
                <label>چه سطحی رو میخواهید شرکت کنید؟</label>
                <div class="radio-group">
                    <label><input type="radio" name="german_level_participate" value="A1"> A1</label>
                    <label><input type="radio" name="german_level_participate" value="A2"> A2</label>
                    <label><input type="radio" name="german_level_participate" value="B1"> B1</label>
                    <label><input type="radio" name="german_level_participate" value="B2"> B2</label>
                </div>
            </div>

            <!-- 8. ساعات مناسب -->
            <div class="field-group required">
                <label>ساعات مناسب برای برگزاری کلاس کدام اند؟</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="preferred_times[]" value="9-10:30"> 9-10:30</label>
                    <label><input type="checkbox" name="preferred_times[]" value="10:30-12"> 10:30-12</label>
                    <label><input type="checkbox" name="preferred_times[]" value="12-13:30"> 12-13:30</label>
                    <div id="a1-only-time" style="display:none;">
                        <label><input type="checkbox" name="preferred_times[]" value="14:30-16 (در حال برگزاری، هفته دوم)"> 14:30-16 (مهدیه نوری)</label>
                    </div>
                    <label><input type="checkbox" name="preferred_times[]" value="13:30-15"> 13:30-15</label>
                    <label><input type="checkbox" name="preferred_times[]" value="15-16:30 (جدید، شروع 16 آذر)"> 15-16:30 (جدید، شروع 16 آذر مرتضی جهش)</label>
                    <label><input type="checkbox" name="preferred_times[]" value="16:30-18"> 16:30-18</label>
                    <label><input type="checkbox" name="preferred_times[]" value="18-19:30"> 18-19:30</label>
                    <label><input type="checkbox" name="preferred_times[]" value="19:30-21 (درحال برگزاری، هفته چهارم)"> 19:30-21 (درحال برگزاری، هفته چهارم)</label>
                    <label><input type="checkbox" name="preferred_times[]" value="21-22:30 (در حال برگزاری، هفته چهارم)"> 21-22:30 (در حال برگزاری، هفته چهارم)</label>
                </div>
            </div>

            <!-- 9. کتاب‌ها -->
            <div class="field-group required">
                <label>با کدام کتاب ها آشنایی دارید؟</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="books[]" value="Menschen"> Menschen</label>
                    <label><input type="checkbox" name="books[]" value="Starten Wir"> Starten Wir</label>
                    <label><input type="checkbox" name="books[]" value="Sicher"> Sicher</label>
                    <label><input type="checkbox" name="books[]" value="Schritte"> Schritte</label>
                    <label><input type="checkbox" name="books[]" value="Studio d"> Studio d</label>
                    <label><input type="checkbox" name="books[]" value="Grammatik Aktiv"> Grammatik Aktiv</label>
                    <label><input type="checkbox" name="books[]" value="هیچ کدام"> هیچ کدام</label>
                    <label><input type="checkbox" name="books[]" value="other"> سایر</label>
                </div>
                <div id="books_other" class="other-field" style="display:none; margin-top:10px;">
                    <input type="text" name="books_other" placeholder="نام کتاب را بنویسید">
                </div>
            </div>

            <!-- 10. چطور آشنا شدید -->
            <div class="field-group required">
                <label>چطور با کلاس های ما آشنا شدید؟</label>
                <div class="radio-group">
                    <label><input type="radio" name="how_found" value="تلگرام" required> تلگرام</label>
                    <label><input type="radio" name="how_found" value="یوتیوب"> یوتیوب</label>
                    <label><input type="radio" name="how_found" value="اینستاگرام"> اینستاگرام</label>
                    <label><input type="radio" name="how_found" value="گوگل"> گوگل</label>
                    <label><input type="radio" name="how_found" value="دوستان"> دوستان</label>
                    <label><input type="radio" name="how_found" value="other"> سایر</label>
                </div>
                <div id="how_found_other" class="other-field" style="display:none; margin-top:10px;">
                    <input type="text" name="how_found_other" placeholder="چگونه آشنا شدید؟">
                </div>
            </div>

            <!-- 11. قوانین -->
            <div class="field-group required">
                <div class="rules-box">
                    <p><strong>قوانین شرکت در کلاس های آنلاین زبان آلمانی:</strong></p>
                    <ol>
                        <li>پیام‌های مرتبط با آموزش: تنها پیام‌های مربوط به آموزش زبان آلمانی در گروه ارسال شود.</li>
                        <li>تحویل تمرین‌ها: تمرین‌های کتبی و صوتی باید در زمان مقرر تحویل داده شوند.</li>
                        <li>عدم ارسال محتوای غیرآموزشی: از ارسال پیام‌های تبلیغاتی، استیکر یا محتوای غیرمرتبط خودداری شود.</li>
                        <li>مشارکت فعال: مشارکت در بحث‌ها و تمرین‌های گروهی مورد انتظار است.</li>
                        <li>احترام متقابل: احترام بین اعضا و مدرس الزامی است.</li>
                        <li>حضور در کلاس: غیبت بدون اطلاع قبلی ممکن است به محدودیت در دسترسی به کلاس‌ها یا حذف از گروه شود.</li>
                        <li>مرور و بازخورد: بازخورد هفتگی مدرس جدی گرفته شود و تمرین‌ها مرور شوند.</li>
                        <li>رعایت زمان‌بندی کلاس: لینک و زمان‌بندی اعلام شده باید رعایت شود.</li>
                    </ol>
                </div>
                <div class="radio-group">
                    <label><input type="radio" name="rules_agreed" value="1" required> موافقم</label>
                </div>
            </div>

            <div class="submit-button">
                <button type="submit">ارسال فرم</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>