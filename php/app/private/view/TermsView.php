<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>利用規約</title>
</head>
<body>
    <div class="section">
        <h2>利用規約</h2>
        <p>この利用規約（以下，「本規約」と表記。）は，チーム家計簿（以下，「当社」と表記）がこのウェブサイト上で提供するサービス（以下，「本サービス」と表記）の利用条件を定めるものです。
            登録ユーザーの皆さま（以下，「ユーザー」と表記。）には，本規約に従って，本サービスをご利用いただきます。</p>

        <h2>第1条(適用)</h2>
        <p><span>1.</span>本規約は，ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。<br>
            <span>2.</span>.当社は本サービスに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下，「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。<br>
            <span>3.</span>本規約の規定が前条の個別規定の規定と矛盾する場合には，個別規定において特段の定めなき限り，個別規定の規定が優先されるものとします。</p>
        
        <h2>第2条(利用登録)</h2>
        <p><span>1.</span>本サービスにおいては，登録希望者が本規約に同意の上，当社の定める方法によって利用登録を申請し，当社がこの承認を登録希望者に通知することによって，利用登録が完了するものとします。<br>
            <span>2.</span>当社は，利用登録の申請者に以下の事由があると判断した場合，利用登録の申請を承認しないことがあり，その理由については一切の開示義務を負わないものとします。</p>
            
        <div class="checkbox-container">
            <input type="checkbox" id="agree-checkbox">
            <label for="agree-checkbox">同意する</label>
        </div>

        <button class="agree-button" id="agree-button" disabled onclick="location.href='registration_complete.html'">
            新規登録へ進む
        </button>
    </div>

    <!-- 利用規約に同意したら次のステップに遷移できるスクリプト -->
    <script>
        const checkbox = document.getElementById('agree-checkbox');
        const agreeButton = document.getElementById('agree-button');
        
        checkbox.addEventListener('change', function() {
            agreeButton.disabled = !this.checked;
        });
    </script>
</html>