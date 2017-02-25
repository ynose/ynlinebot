<?php

$accessToken = 'huTANryz57LHbpGQCtKg2ZC9rEZeG3QEfwIC85zZjqLhKQv+wPyC2FJ2KgnchVUic3doAfurSw1CUbbwPVESgyKbZRc1eDPaXMfss2gFDNiFABFRcUKw94L+wosnBkFL4oayHBOwvjaaWvdgkMb96QdB04t89/1O/w1cDnyilFU=';

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

$event = $jsonObj->{"events"}[0]->{"type"};

//メッセージ以外のときは何も返さず終了
if($type == "text"){

  $response_format = [
    "type" => "text",
    "text" => "テストOKです！"
  ];

  if (strpos($text, '今日') !== false && strpos($text, '何日') !== false) {
    $timestamp = time();
    $year = date('Y', $timestamp);
    $jyear = $year - 1988;
    $reply = '平成' . $jyear . date('年m月d日', $timestamp) . 'です。';
    $response_format = [
      "type" => "text",
      "text" => $reply
    ];
  }

  if (strpos($text, 'LED') !== false && strpos($text, 'つけて') !== false) {
    $response_format = [
      "type" => "template",
      "altText" => "何色をつけますか？",
      "template" => [
          "type" => "buttons",
          "thumbnailImageUrl" => "https://dl.dropboxusercontent.com/u/7598940/LINEBOT.JPG",
          "title" => "LED",
          "text" => "何色をつけますか？",
          "actions" => [
              [
                "type" => "postback",
                "label" => "赤",
                "data" => "red"
              ],
              [
                "type" => "postback",
                "label" => "黄",
                "data" => "yellow"
              ],
              [
                "type" => "postback",
                "label" => "青",
                "data" => "blue"
              ]
          ]
      ]
    ];
  }

}

if ($event == 'postback') {
  $led = $jsonObj->{"events"}[0]->{"postback"}->{"data"};
  switch ($led) {
    case "red":
      $pin = "D13";
      break;
    case "yellow":
      $pin = "D15";
      break;
    case "blue":
      $pin = "D0";
      break;
  }

  // blynkでLEDをつける
  $blynk = curl_init();
  curl_setopt($blynk, CURLOPT_URL, "https://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0?value=1");
  curl_setopt($blynk, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($blynk, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($blynk, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($blynk, CURLOPT_HEADER, FALSE);

  $response = curl_exec($blynk);
  curl_close($blynk);
  
  return;
  // $response_format = [
  //   "type" => "text",
  //   "text" => $led . ' (' . $pin . ')'
  // ];

}

//返信データ作成
$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format]
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
