document.getElementById('loginform').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const error = document.getElementById('error-msg');

    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password }),
    }).then(async (response) => {
        if (response.status === 200) {
            const data = await response.json();

            console.log(data);

            error.textContent = 'ログイン成功';
            error.style.display = 'block';

            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } else {
            const data = await response.json();
            error.textContent = data.error || 'エラーが発生しました';
            error.style.display = 'block';
        }
    });
});