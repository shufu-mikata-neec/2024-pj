document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirm = document.getElementById('confirmPassword').value;

    // email validation
    const email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email_regex.test(email)) {
        const error = document.querySelector('.email .error');
        error.textContent = '正しいメールアドレスを入力してください';
        return;
    } else {
        const error = document.querySelector('.email .error');
        error.textContent = '';
    }

    if (password !== password_confirm) {
        const error = document.querySelector('.password_confirm .error');
        error.textContent = 'パスワードが一致しません';
        return;
    } else {
        const error = document.querySelector('.password_confirm .error');
        error.textContent = '';
    }

    const data = {
        username: username,
        email: email,
        password: password
    };

    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    }).then(async (response) => {
        if (response.status === 200) {
            const data = await response.json();

            if (data.redirect) {
                console.log(data.redirect);
                window.location.href = data.redirect;
            }
        } else {
            const data = await response.json();
            if (data.error.email) {
                const error = document.querySelector('.email .error');
                error.textContent = data.error.email;
            } else {
                const error = document.querySelector('.email .error');
                error.textContent = '';
            }
        }
    });
});