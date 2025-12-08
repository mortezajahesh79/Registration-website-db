<?php
// process.php - پردازش فرم، چک تکراری ایمیل و ذخیره در دیتابیس

require_once 'config.php'; // اتصال به دیتابیس

// فقط اگر روش POST باشه اجرا بشه
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// تابع sanitize ورودی‌ها
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

try {
    // دریافت و sanitize داده‌ها
    $email = sanitize($_POST['email'] ?? '');
    $full_name = sanitize($_POST['full_name'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $telegram_id = sanitize($_POST['telegram_id'] ?? '');
    $nationality = sanitize($_POST['nationality'] ?? '');
    $country = sanitize($_POST['country'] ?? '');

    // سطح آلمانی
    $german_level = sanitize($_POST['german_level'] ?? '');
    $german_level_other = ($german_level === 'other') ? sanitize($_POST['german_level_other'] ?? '') : null;
    
    // سطحی که می‌خواهند شرکت کنند
    $desired_level = sanitize($_POST['german_level_participate'] ?? ''); 
   // بعد از خط $country = ...
    // ساعات مناسب (چک‌باکس‌ها)
    $preferred_times = isset($_POST['preferred_times']) && is_array($_POST['preferred_times'])
        ? implode(', ', array_map('sanitize', $_POST['preferred_times']))
        : '';

    // کتاب‌ها
    $books = isset($_POST['books']) && is_array($_POST['books'])
        ? implode(', ', array_map('sanitize', $_POST['books']))
        : '';
    $books_other = (isset($_POST['books']) && in_array('other', $_POST['books'])) ? sanitize($_POST['books_other'] ?? '') : null;

    // چطور آشنا شدید
    $how_found = sanitize($_POST['how_found'] ?? '');
    $how_found_other = ($how_found === 'other') ? sanitize($_POST['how_found_other'] ?? '') : null;

    // قوانین
    $rules_agreed = isset($_POST['rules_agreed']) && $_POST['rules_agreed'] == '1' ? 1 : 0;

    // چک کردن فیلدهای اجباری (دوباره در سرور برای امنیت)
    if (empty($email) || empty($full_name) || empty($telegram_id) || empty($nationality) || empty($country) 
        || empty($german_level) || empty($desired_level)|| empty($preferred_times) || empty($books) || empty($how_found) || $rules_agreed !== 1) {
        header('Location: index.php?status=error');
        exit;
    }

    // چک تکراری بودن ایمیل (مهم‌ترین بخش!)
    $stmt = $pdo->prepare("SELECT id FROM registrations WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        // ایمیل تکراری
        header('Location: index.php?status=email_exists');
        exit;
    }

    // آماده‌سازی داده‌ها برای INSERT
$sql = "INSERT INTO registrations (
            email, full_name, phone, telegram_id, nationality, country,
            desired_level,
            german_level, german_level_other, preferred_times, books, books_other,
            how_found, how_found_other, rules_agreed
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

    $stmt = $pdo->prepare($sql);
$stmt->execute([
    $email, $full_name, $phone, $telegram_id, $nationality, $country,
    $desired_level,  // ← جدید
    $german_level === 'other' ? "سایر: $german_level_other" : $german_level,
    $german_level_other,
    $preferred_times,
    $books === 'other' ? "سایر: $books_other" : $books,
    $books_other,
    $how_found === 'other' ? "سایر: $how_found_other" : $how_found,
    $how_found_other,
    $rules_agreed
]);

    // موفقیت → ریدایرکت به صفحه اصلی با پیام موفقیت
    header('Location: index.php?status=success');
    exit;

} catch (Exception $e) {
    // در صورت خطا (مثلاً مشکل دیتابیس)
    // در محیط توسعه می‌تونی خطا رو لاگ کنی، اما به کاربر فقط پیام عمومی نشون بده
    error_log($e->getMessage());
    header('Location: index.php?status=error');
    exit;
}
?>