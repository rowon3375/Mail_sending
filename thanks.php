<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>メール送信システムテスト</title>
<meta name="description" content="">
<meta name="keyword" content="メール送信システムテスト">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<!-- css -->
<link rel="stylesheet" type="text/css" href="/css/html5reset-1.6.1.css">
<link rel="stylesheet" type="text/css" href="/css/validationEngine.jquery.css">
<!-- js -->
<script src="/common/js/jquery.validationEngine-ja.js"></script>
<script src="/common/js/jquery.validationEngine.min.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>
<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/common/parts/header.php"); ?>
<main>
<article class="basicPage">
<div id="ttlBox">
 <div class="flex"><h1><span class="en">CONTACT</span>お問い合わせ</h1></div>
</div>
<section class="request confirmation">
  <div class="inner">
    <h2>お問い合わせありがとうございます。</h2>
    <p>ご入力頂いた情報は無事に送信されました。<br class="pc">確認のためお客様へ自動配信メールをお送りさせて頂きました。</p>
    <div class="thanks">
      <a href="/" class="thanksbtn">トップページに戻る</a>
    </div>
  </div>
</section>
  
</article>
</main>
<script src="https://www.google.com/recaptcha/api.js?render=recaptcha key入れる"></script>
<script>
    // recaptcha
    window.addEventListener('load', function() {
        document.getElementById('contactForm').addEventListener('submit', e => {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('recaptcha key入れる', {
                    action: 'submit'
                }).then(function(token) {
                    var isError = Array.from(document.getElementsByClassName('formError')).some(el => el.style.display == 'block');
                    if (!isError) {
                        document.getElementById('my_token').value = token;
                        document.getElementById('contactForm').submit();
                    }
                });
            });
        }, false);
    });
</script>
</body>
</html>