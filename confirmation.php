
<?php
  session_start();

// reCaptcha V3検証
recaptcha_check();
function recaptcha_check()
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => array(
            'secret' => 'ecaptcha key入れる',
            'response' => $_POST['g-recaptcha-response'],
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ),
    ));
    $res = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($res);
    $action_name = 'submit';
    if ($response->success && $response->action === $action_name && $response->score >= 0.8) {
        // 検証合格
    } else {
        // 検証エラー
        header('Location: /');
        exit();
    }
}

// リロードによる重複送信を防ぐためのセッションキー
$_SESSION["request"] = md5(uniqid() . mt_rand());

?>
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
<main>
<article class="basicPage">
<div id="ttlBox">
 <div class="flex"><h1><span class="en">CONTACT</span>お問い合わせ</h1></div>
</div>
<section class="request confirmation">
  <div class="inner">
    <h2>内容確認</h2>
    <p>入力内容に間違いがないかご確認ください。</p>
    <form action="send.php" method="post" id="contactForm">
        <?php foreach($_POST as $key => $row){
            $_SESSION[$key] = $row; ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $row ?>">
        <?php } ?>
      <dl>
        <div>
          <dt>氏名<span>必須</span></dt>
          <dd>
           <?php echo htmlspecialchars($_POST['name01'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>フリガナ<span>必須</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['name02'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>メールアドレス<span>必須</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['e_mail01'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>電話番号<span>必須</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['tel01'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>社名、学校、団体名<span>必須</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['g_name'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>お問い合わせ項目<span>必須</span></dt>
          <dd>
          <?php echo $_POST['iq_section']?>
          </dd>
        </div>
        <div>
          <dt>お問い合わせ内容<span>必須</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['inquiry01'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>弊社および弊社が提供するサービスをどのようにしてお知りになりましたか？<span>必須</span></dt>
          <dd>
            <?php 
                if($_POST['questionnaire'] == "DM"){
                  echo "DM<br>".$_POST['questionnaire_year']."年　".$_POST['questionnaire_month']."月";
                } elseif($_POST['questionnaire'] == "ご紹介"){
                  echo "ご紹介<br>"."ご紹介者名・法人名：　".$_POST['questionnaire_name'];
                } else{
                  echo $_POST['questionnaire'];
                }
            ?>
          </dd>
        </div>
        <div>
          <dt>郵便番号<span class="nini">任意</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['zip'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>ご住所<span class="nini">任意</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['address'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
        <div>
          <dt>FAX番号<span class="nini">任意</span></dt>
          <dd>
          <?php echo htmlspecialchars($_POST['fax01'],ENT_QUOTES,'UTF-8'); ?>
          </dd>
        </div>
      </dl>
      <div class="btn_submit">
        <input type="hidden" name="g-recaptcha-response" id="my_token">
        <div><button type="submit" id="submitbutton" class="submitBtn"><span>この内容で送信</span></button></div>
        <div><input type="button" class="back-btn" onClick="history.back(-1);" value="修正する"></div>
      </div>
    </form>
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
