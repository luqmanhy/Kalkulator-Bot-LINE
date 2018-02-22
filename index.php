<?php

require_once('./line/line_class.php');
require_once('./config.php');

include "./Math/EvalMath.php";
include "./Math/Stack.php";


$client = new LINEBot($channelAccessToken, $channelSecret);

$userId         = $client->parseEvents()[0]['source']['userId'];
$replyToken     = $client->parseEvents()[0]['replyToken'];
$timestamp      = $client->parseEvents()[0]['timestamp'];
$message        = $client->parseEvents()[0]['message'];
$messageid      = $client->parseEvents()[0]['message']['id'];
$profil         = $client->profil($userId);

$msg_receive   = $message['text'];


if($message['type']=='text'){

	$msg_xpl = explode(" ", $msg_receive);
	$keyword = $msg_xpl[0];

	if($keyword=='/menu') {

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'text',                   
					'text' => 'Perintah :
					/menu : menampilkan menu
					/hitung 3+3 : kalkulator'
				)
			)
		);

		$client->replyMessage($balas);

	}elseif($keyword=='/hitung'){

		$m = new EvalMath;
		$result = $m->evaluate($msg_xpl[1]);

		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'text',                   
					'text' => $result
				)
			)
		);

		$client->replyMessage($balas);
	}
}