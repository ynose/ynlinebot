<?php
include_once ('DatetimeUtility.php');

$accessToken = 'huTANryz57LHbpG
QCtKg2ZC9rEZeG3QEfwIC85zZjqLhKQv+wPyC2FJ2KgnchVUic3doAfurSw1CUbbwPVESgyKbZRc1eDPaXMfss2gFDNiFABFRcUKw94L+wosnBkFL4oayHBOwvjaaWvdgkMb96QdB04t89/1O/w1cDnyilFU=';

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//メッセージ以外のときは何も返さず終了
if($type != "text"){
	exit;
}
$reply = "テストOKです！";
//if (strpos($text, '今日') !== false && strpos($text, '何日') !== false) {
	$reply = DatetimeUtility->date('JK年n月j日') . 'です。';
//}

//返信データ作成
$response_format_text = [
	"type" => "text",
	"text" => $reply	
];
$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format_text]
	];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
    ));
$result = curl_exec($ch);
curl_close($ch);

?>
