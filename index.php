<?php

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token =
'ga8pQMcoauY4Va26gopt2nGpF4cS3MGhtg85GTNrQfVytm9UZy8mji1/CPiNVv94s1aNd0p7bVqvAAKs3A86d6+4Vl0eSq72bPrl7WVC9zz/Qb7FJTp7GbaA/xzbbD6pqz+Cdj84BTTEQ3JqJIP2kgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '4d55dc3940c9af9c4c80b7ffc09608c6';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {
        // Loop through each event
        foreach ($events['events'] as $event) {

            // Get replyToken
            $replyToken = $event['replyToken'];
            $ask = $event['message']['text'];

            switch(strtolower($ask)) {
                case 'สวัสดี' :
                case 'สวัสคับ' :
                case 'สวัสดีครับ' :
                case 'สวัสดีค่ะ' :
                case 'สวัสดีคะ' :
                case 'หวัดดี' :
                case 'หวัดดีคับ' :
                case 'หวัดดีครับ' :
                case 'หวัดดีค่ะ' :
                case 'หวัดดีคะ' :
                case 'ดี' :
                case 'ดีครับ' :
                case 'ดีคับ' :
                case 'ดีคะ' :
                case 'ดีค่ะ' :
                        $respMessage = 'สวัสดีค่ะ';
                    break;
                case 'f':
                case 'F':
                        $respMessage = 'Love you lady.';
                    break;
                default:
                    $respMessage = 'What is your sex? M or F';
                    break;
            }
            $httpClient = new CurlHTTPClient($channel_token);
            $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    }
}
echo "OK";