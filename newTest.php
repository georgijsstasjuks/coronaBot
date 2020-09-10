<?php
require 'vendor/autoload.php';
require 'translate.php';
require 'corona.php';
const TOKEN ='1002035297:AAFEFP0ouA_gMSD7KffsFqkJfkBpNXPLCn8';
const baseUrl = 'https://api.telegram.org/bot'. TOKEN . '/';

$update = json_decode(file_get_contents('php://input'),JSON_OBJECT_AS_ARRAY); 

$chat_id= $update['message']['chat']['id'];
$text= $update['message']['text'];

function sendRequest($method,$params=[]){
    if(!empty($params)){
         $url= baseUrl . $method . '?' . http_build_query($params);
    }
    else
    {
        $url= baseUrl . $method;
    }
    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}
            if($text=='/start'){
                sendRequest('sendMessage',['chat_id'=> $chat_id,'text'=>'Введите название страны для получения статистики']);
            }else{
                if($text=='Америка')$text='USA';
                if($text=='Англия') $text='Объединенное Королевство';
            $statistic = getStatistic(getTranslate($text));
            if($statistic){
                    $messageTotal = 'Всего случаев заражения: ' . $statistic['total_cases'] . "\n" .'Всего смертей: ' . $statistic['total_deaths'] . "\n" . 'Всего выздоровело: ' . 
                     $statistic['total_recovered'] ."\n" . 'Больных на данный момент: ' .    $statistic['total_active'] . "\n";      
                     $messageToday =  'Новых случаев за сутки: ' .  $statistic['cases_today']  . "\n" . 'Смертей за сутки: ' .  $statistic['deaths_today'] . "\n" . 'В критическом состоянии: '
                     . $statistic['serious'];       

                sendRequest('sendMessage',['chat_id'=> $chat_id,'text'=> $messageTotal . $messageToday]);
            }
    
             else
            sendRequest('sendMessage',['chat_id'=> $chat_id,'text'=>'Такая страна не найдена, проверьте правильность написания!']);
        }

?>