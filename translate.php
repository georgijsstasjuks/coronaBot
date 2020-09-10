<?php

use \Dejurin\GoogleTranslateForFree;

 function getTranslate($country){
        $db_connect = pg_connect("host=localhost port=5432 dbname=botelegram user=postgres password=admin");
        $source = 'ru';
        $target = 'en';
        $attempts = 5;
        $text = $country;
        $tr = new GoogleTranslateForFree();
        $q = $tr->translate($source, $target, $text, $attempts);
        return $q;
}



