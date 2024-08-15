<?php

require 'vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

if (isset($_GET['lang']) && isset($_GET['text'])) {
    $lang = $_GET['lang'];
    $text = $_GET['text'];
    $tr = new GoogleTranslate($lang);
    try {
        $translatedText = $tr->translate($text);
        echo $translatedText;
    } catch (Exception $e) {
        echo 'Translation error';
    }
} else {
    echo 'Invalid request';
}

