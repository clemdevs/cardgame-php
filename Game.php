<?php

require 'vendor/autoload.php';

use CardGame\Deck;

$deck = new Deck();

$deck->shuffle();
$cards = $deck->draw(3);
foreach ($cards as $card) {
    echo $card . "\n";
}