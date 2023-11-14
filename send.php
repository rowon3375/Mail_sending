<?php
// リロードによる重複送信対策
session_start();

$domain = $_SERVER['HTTP_HOST'];

if (empty($_SESSION['request'])) {
  $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/request';
  header('Location: ' . $url);
  exit;
}
$_SESSION['request'] = '';

//サービス
if($_POST['questionnaire'] == "DM"){
  $_POST['questionnaire']  = "DM"."\n".$_POST['questionnaire_year']."年　".$_POST['questionnaire_month']."月";
} elseif($_POST['questionnaire'] == "ご紹介"){
  $_POST['questionnaire'] = "ご紹介"."\n"."ご紹介者名・法人名：　".$_POST['questionnaire_name'];
}
if($_POST['zip'] == ""){
  $_POST['zip'] = "入力内容無し";
} 
if($_POST['address'] == "" ){
  $_POST['address'] = "入力内容無し";
} 
if($_POST['fax01'] == ""){
  $_POST['fax01'] = "入力内容無し";
}


date_default_timezone_set('Asia/Tokyo');

if (!file_exists("log")) {
  @mkdir("log", 0777);
}

//ip修得
$ip = getenv("REMOTE_ADDR");

// ログファイルに書き込むデータ
$logdata = [
  date('[d日 H:i:s]'),
  $_POST['name01'],
  $_POST['name02'],
  '"' . $_POST['tel01'] . '"', // エクセルで開いた際に先頭の0が消えるで""で囲って対処
  $_POST['e_mail01'],
  $_POST['g_name'],
  $_POST['iq_section'],
  $_POST['inquiry01'],
  $_POST['questionnaire'],
  '"' . $_POST['zip'] . '"',
  $_POST['address'],
  '"' . $_POST['fax01'] . '"',
  $ip
];
$today = date("Y-m-d");
$fp = fopen("log/{$today}.csv", "a");
stream_filter_prepend($fp, 'convert.iconv.utf-8/cp932'); // エクセル用の文字コードに変換
fputcsv($fp, $logdata);
fclose($fp);

/************************************
          管理者用のメール
**************************************/
// 言語、文字コードを指定
mb_language("Ja");
mb_internal_encoding("UTF-8");


// デモ・本番ドメイン分ける
if ($domain === '/') {
  $manager_email_string = "ilove4622@gmail.com"; //本番
} else{
  $manager_email_string = "ilove4622@naver.com"; //デモ
}


$headers = "From:" . mb_encode_mimeheader("会社名") . "<ilove4622@gmail.com>\n";
$manager_title = "ホームページからお問い合わせがありました。";
$manager_message = <<< EOM

----------------------------------------------------------------

以下の内容でお客様よりご連絡がありました。


【 氏名 】: {$_POST['name01']}

【 フリガナ 】: {$_POST['name02']}

【 メールアドレス 】: {$_POST['e_mail01']}

【 電話番号 】: {$_POST['tel01']}

【 社名、学校、団体名 】: {$_POST['g_name']}

【 お問い合わせ項目 】: {$_POST['iq_section']}

【 お問い合わせ内容 】: {$_POST['inquiry01']}

【 弊社を知った経路 】: {$_POST['questionnaire']}

【 郵便番号 】: {$_POST['zip']}

【 ご住所 】: {$_POST['address']}

【 FAX番号 】: {$_POST['fax01']}

【 ホストIP 】: {$ip}

----------------------------------------------------------------


EOM;

//メール送信（管理者）
$manager = mb_send_mail($manager_email_string, $manager_title, $manager_message, $headers);


/************************************
          お客様用のメール
**************************************/
$customer_email = $_POST['e_mail01'];
$headers = "From:" . mb_encode_mimeheader("会社名") . "<ilove4622@gmail.com>\n";
$customer_title = "〇〇会社から　お問い合わせをありがとうございました。";
$customer_message = <<< EOM

----------------------------------------------------------------

以下の内容でお受付いたしました。
後日担当者よりご連絡を差し上げます。
お問い合わせをありがとうございました。


【 氏名 】: {$_POST['name01']}

【 フリガナ 】: {$_POST['name02']}

【 メールアドレス 】: {$_POST['e_mail01']}

【 電話番号 】: {$_POST['tel01']}

【 社名、学校、団体名 】: {$_POST['g_name']}

【 お問い合わせ項目 】: {$_POST['iq_section']}

【 お問い合わせ内容 】: {$_POST['inquiry01']}

【 弊社を知った経路 】: {$_POST['questionnaire']}

【 郵便番号 】: {$_POST['zip']}

【 ご住所 】: {$_POST['address']}

【 FAX番号 】: {$_POST['fax01']}

----------------------------------------------------------------

EOM;

//メール送信（お客様）
$customer = mb_send_mail($customer_email, $customer_title, $customer_message, $headers);

header('Location:./thanks.php');
exit();
?>