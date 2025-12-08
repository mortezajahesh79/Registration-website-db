<?php
// config.php - تنظیمات اتصال به دیتابیس

// تنظیمات دیتابیس (بعداً این‌ها رو با اطلاعات خودت جایگزین کن)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // معمولاً در XAMPP/WAMP/Laragon همین root هست
define('DB_PASS', '');            // اگر پسورد گذاشتی، اینجا بنویس (در XAMPP پیش‌فرض خالیه)
define('DB_NAME', 'deutsch_class_web');

// تنظیمات اضافی برای PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // خطاها رو به صورت exception نشون بده
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // نتایج رو به صورت آرایه انجمنی برگردونه
    PDO::ATTR_EMULATE_PREPARES   => false,                  // prepared statements واقعی استفاده بشه
];

try {
    // ایجاد اتصال PDO
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // در محیط توسعه خطا رو نشون بده، در پروداکشن بهتره لاگ بشه و پیام عمومی نمایش داده بشه
    die("خطا در اتصال به دیتابیس: " . $e->getMessage());
}
?>