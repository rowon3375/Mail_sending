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
<section class="request">
  <div class="inner">
    <h2>お問合せフォーム</h2>
    <p>当社および当社サービスに関するお問い合わせがございましたら<br class="pc">下記フォームよりお問い合わせください。</p>
    
    <form action="confirmation.php" method="post" id="contactForm" novalidate>
      <dl>
        <div>
          <dt>氏名<span>必須</span></dt>
          <dd>
            <input name="name01" type="text" value="" placeholder="例）山田太郎" class="validate[required]" data-prompt-position="bottomLeft">
          </dd>
        </div>
        <div>
          <dt>フリガナ<span>必須</span></dt>
          <dd>
            <input name="name02" type="text" value="" placeholder="例）ヤマダタロウ" class="validate[required]" data-prompt-position="bottomLeft">
          </dd>
        </div>
        <div>
          <dt>メールアドレス<span>必須</span></dt>
          <dd>
            <input name="e_mail01" type="text" value="" placeholder="例）sample@gmail.com" class="validate[required,custom[email]]" data-prompt-position="bottomLeft">
          </dd>
        </div>
        <div>
          <dt>電話番号<span>必須</span></dt>
          <dd>
            <input name="tel01" type="tel" value="" placeholder="例）1234567891" class="validate[required,custom[phone]]" data-prompt-position="bottomLeft">
          </dd>
        </div>
        <div>
          <dt>社名、学校、団体名<span>必須</span></dt>
          <dd>
            <input name="g_name" type="text" value="" placeholder="例）株式会社アネムホールディングス" class="validate[required]" data-prompt-position="bottomLeft">
          </dd>
        </div>
        <div>
          <dt>お問い合わせ項目<span>必須</span></dt>
          <dd>
            <ul class="flex list_radio">
              <li>
                <label>
                    <input name="iq_section" type="radio" value="資料請求" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>資料請求</span>
                </label>
              </li>
              <li>
                <label>
                    <input name="iq_section" type="radio" value="ご質問" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>ご質問</span>
                </label>
              </li>
              <li>
                <label>
                    <input name="iq_section" type="radio" value="その他" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>その他</span>
                </label>
              </li>
            </ul>
          </dd>
        </div>
        <div>
          <dt>お問い合わせ内容<span>必須</span></dt>
          <dd>
            <textarea name="inquiry01" placeholder="お問い合わせの内容をご入力ください。" class="validate[required]" data-prompt-position="bottomLeft"></textarea>
          </dd>
        </div>
        <div>
          <dt>弊社および弊社が提供するサービスをどのようにしてお知りになりましたか？<span>必須</span></dt>
          <dd>
            <ul class="flex list_radio">
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="インターネット検索" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>インターネット検索</span>
                </label>
              </li>
              <li>
                <label>
                  <input name="questionnaire" type="radio" value="DM" class="validate[required]" data-prompt-position="bottomLeft">
                  <span>DM（ 
                    <input name="questionnaire_year" type="text" value="" placeholder="2022" class="dm_y"> 年 
                    <input name="questionnaire_month" type="text" value="" placeholder="10" class="dm_m"> 月 ）
                  </span>
                </label>
              </li><br>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="私塾界" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>私塾界</span>
                </label>
              </li>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="私塾界セミナー（セミナーで配布されたチラシ含む）" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>私塾界セミナー（セミナーで配布されたチラシ含む）</span>
                </label>
              </li><br>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="塾と教育" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>塾と教育</span>
                </label>
              </li>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="塾と教育セミナー（セミナーで配布されたチラシ含む）" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>塾と教育セミナー（セミナーで配布されたチラシ含む）</span>
                </label>
              </li><br>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="ご紹介" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>ご紹介（ご紹介者名・法人名 <input name="questionnaire_name" type="text" value="" class="questionnaire_n"> ）</span>
                </label>
              </li>
              <li>
                <label>
                    <input name="questionnaire" type="radio" value="その他" class="validate[required]" data-prompt-position="bottomLeft">
                    <span>その他
                    </span>
                </label>
              </li>
            </ul>
          </dd>
        </div>
        <div>
          <dt>郵便番号<span class="nini">任意</span></dt>
          <dd>
            〒<input type="tel" name="zip" id="zip" placeholder="0000000" class="sizesmall" value="">
            <input type="button" onkeyup="AjaxZip3.zip2addr('zip','','address','address');" onclick="AjaxZip3.zip2addr('zip','','address','address');" value="住所検索" class="zipbtn">
          </dd>
        </div>
        <div>
          <dt>ご住所<span class="nini">任意</span></dt>
          <dd>
            <input type="text" name="address" id="address" value="" placeholder="例）福岡県福岡市中央区薬院一丁目6番9号 Vビル8F">
          </dd>
        </div>
        <div>
          <dt>FAX番号<span class="nini">任意</span></dt>
          <dd>
            <input name="fax01" type="tel" value="" placeholder="例）1234567">
          </dd>
        </div>
      </dl>
      <div class="agree t_kind">
        <p>当社<a href="/company/#privacy" target="_blank">プライバシーポリシー</a>に同意頂ける場合は<br class="pc">「同意する」にチェックをつけ「⼊⼒内容の確認」ボタンをクリックしてください。</p>
        <span class="submit" style="text-align:center;">
          <label><span id="agree"><input type="checkbox" name="privacy" value="同意する" id="privacy" class="validate[required]" data-prompt-position="bottomLeft"/></span>プライバシーポリシーに同意する</label>
        </span>
      </div>
      <div class="btn_submit">
        <input type="hidden" name="g-recaptcha-response" id="my_token">
        <button type="submit" id="submitbutton" class="submitBtn"><span>入力内容の確認</span></button>
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
<script>
    $(function() {
      jQuery("#contactForm").validationEngine({
        scrollOffset: 150,
      });
    });
</script>
</body>
</html>
