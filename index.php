<?php

$accessToken = '���Ȃ��̃A�N�Z�X�g�[�N���I';


//���[�U�[����̃��b�Z�[�W�擾
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//���b�Z�[�W�擾
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken�擾
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//���b�Z�[�W�ȊO�̂Ƃ��͉����Ԃ����I��
if($type != "text"){
	exit;
}

//�ԐM�f�[�^�쐬
$response_format_text = [
	"type" => "text",
	"text" => "�����f�[�X�I"
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
