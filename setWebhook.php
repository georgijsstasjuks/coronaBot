<?php
const TOKEN ='1074214690:AAEH-tw_ToGRC8C1GmC1XFOGxc0keeD1tHo';
$method = 'setWebhook';
$url = 'https://api.telegram.org/bot'. TOKEN . '/' . $method;


$options = [
    'url' =>'https://e8206034f60b.ngrok.io/turismo/newTest.php'
];
$response = file_get_contents($url. '?'. http_build_query($options) );
var_dump($response);
?>

