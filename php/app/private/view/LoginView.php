<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <div class="container">
        <h1>ログイン</h1>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="email">メールアドレスまたはユーザー名:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">ログイン</button>
        </form>

        <div class="links">
            <a href="04PasswordResetMailSendedView.html">パスワードを忘れた場合</a>
            <a href="06MemberRegisterView.html">新規登録</a>
        </div>
    </div>
</body>
</html>