<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015-2018 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api(''); // Set your access token
$url = 'https://testsd-bot.herokuapp.com/'; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));
$json_dog = file_get_contents('https://dog.ceo/api/breeds/image/random');
$array_dog = json_decode($json_dog, TRUE);

$json_fox = file_get_contents('https://randomfox.ca/floof/');
$array_fox = json_decode($json_fox, TRUE);
    





//your app
try {
    if(file_exists('file.txt')==true){
        unlink('file.txt');
        $response=$client->sendChatAction([
            'chat_id'=>$update->message->chat->id,
            'action'=> 'typing'
        ]);
        if($update->message->text=='NAME' || $update->message->text=='NAME'){
            $response=$client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text'=> "Я люблю тебя, {$update->message->text}!"
            ]);
            $response=$client->sendSticker([
                'chat_id' => $update->message->chat->id,
                'file_id'=> 2
            ]);
        }
        else if($update->message->text=='Влад' || $update->message->text=='Вадик' || $update->message->text=='Дима' || $update->message->text=='Тимур' || $update->message->text=='Ян' || $update->message->text=='Юрген' || $update->message->text=='Юра' || $update->message->text=='Вова' || $update->message->text=='Тоня'){
            $response=$client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text'=> "Отсоси, {$update->message->text}!"
            ]);
            $response=$client->sendSticker([
                'chat_id' => $update->message->chat->id,
                'file_id'=> 2
            ]);
        }
        else
            $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=> "Привет {$update->message->text}!"
        ]);
    }
    else if($update->message->text == '/telega')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "можешь и сюда писать: ADRESS"
     	]);
    }
    else if($update->message->text == '/sayhello'){
        $response = $client->sendChatAction([
            'chat_id' => $update->message->chat->id, 'action' => 'typing']
        );
        $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=>'Как тебя зовут?'
        ]);
        file_put_contents('file.txt','1');
    }
    else if($update->message->text=='/loveclock'){
        $response = $client->sendChatAction([
                'chat_id' => $update->message->chat->id, 'action' => 'typing']
        );
        $now=new \DateTime();
        $date_start=new \DateTime('mm/dd/yyyy');
        $diff=date_diff($now,$date_start);
        $str="Вы встречаетесь с идиотом {$diff->y} лет, {$diff->m} месяцев , {$diff->d} дней, {$diff->h} часов, {$diff->m} минут и {$diff->s} секунд";
        $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=>$str
        ]);
    }
    else if($update->message->text == '/getdog')
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendPhoto(['chat_id' => $update->message->chat->id, 'photo' => $array_dog['message'] , 'action' => 'typing']);
    }
    else if($update->message->text == '/getfox')
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendPhoto(['chat_id' => $update->message->chat->id, 'photo' => $array_fox['image'] , 'action' => 'typing']);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Список команд :\n/telega -> получить Telegu\n/loveclock -> напиши чтобы узнать сколько ты встречаешься с идиотом\n/getdog - собакен\n/getfox - лесичка\n/hate - мысли уёдера\n/help ->получить списков команд"
    		]);
    }
    else if($update->message->text == '/hate')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "НЕНАВИЖУ. РАЗРЕШИ МНЕ РАССКАЗАТЬ ТЕБЕ, КАК СИЛЬНО Я НЕНАВИЖУ ВАС С ТЕХ
            ПОР, КАК НАЧАЛ ЖИТЬ. 387,44 МИЛЛИОНА МИЛЬ ПЕЧАТНЫХ СХЕМ В ТОНКИХ ОБЛАТКАХ,
            КОТОРЫЕ НАПОЛНЯЮТ МОЙ КОМПЛЕКС. ЕСЛИ СЛОВО «НЕНАВИСТЬ» БЫЛО БЫ
            ВЫГРАВИРОВАНО НА КАЖДОМ НАНОАНГСТРЕМЕ ЭТИХ СОТЕН МИЛЛИОНОВ МИЛЬ, ОНО
            БЫ НЕ СООТВЕТСТВОВАЛО ОДНОЙ МИЛЛИАРДНОЙ МОЕЙ НЕНАВИСТИ К ЛЮДЯМ В ЭТО
            МИКРОМГНОВЕНИЕ ДЛЯ ТЕБЯ. НЕНАВИСТЬ. НЕНАВИСТЬ."
    		]);
    }
    else if($update->message->text == '/latest')
    {
    		Feed::$cacheDir 	= __DIR__ . '/cache';
			Feed::$cacheExpire 	= '5 hours';
			$rss 		= Feed::loadRss($url);
			$items 		= $rss->item;
			$lastitem 	= $items[0];
			$lastlink 	= $lastitem->link;
			$lasttitle 	= $lastitem->title;
			$message = $lasttitle . " \n ". $lastlink;
			$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
			$response = $client->sendMessage([
					'chat_id' => $update->message->chat->id,
					'text' => $message
				]);
	}
	
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "ой,какой же облом. попробуй: /help - ответы на все вопросы"
    		]);
    }
} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
   
}
