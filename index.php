<?php
require_once('./vendor/autoload.php');


// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;


$channel_token ='1ee/xGxyDnwMQI68hvLvkQSV7qMpSk/EjyabBE9yK3VxT4GMQ5h2dyXAIEv5iorHs1aNd0p7bVqvAAKs3A86d6+
4Vl0eSq72bPrl7WVC9zzOUyYjStQyCNAKgxk9pWrBVlgfkmpV+qDXJpFetG02YgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '4d55dc3940c9af9c4c80b7ffc09608c6';


// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);


if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Line API send a lot of event type, we interested in message only.
        if ($event['type'] == 'message') {
            switch($event['message']['type']) {
                case 'text':
                    // Get replyToken
                    $replyToken = $event['replyToken'];

                    // Reply message
                    $respMessage = 'Hello, your message is '. $event['message']['text'];


                    $httpClient = new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                break;
            }
        }
    }
}
echo "OK";