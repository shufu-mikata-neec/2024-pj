document.getElementById('add').addEventListener('click', () => {

    const category = document.getElementById('category_name').value;

    if (category.replace(/\s/g, '') === '') {
        alert('カテゴリ名を入力してください');
        return;
    }

    const type = document.getElementById('category_type').value;
    const id = document.getElementById('uid').value;

    const data = {
        name: category,
        type: type,
        uid: id
    }

    fetch('/add_category', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    }).then(async (response) => {
        if (response.status === 201) {
            // 同じページにリダイレクト
            window.location.href = '/add_category';
        } else {
            alert('Failed code: ' + response.status);
        }
    })
});