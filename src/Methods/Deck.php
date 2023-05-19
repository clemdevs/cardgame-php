<?php

namespace CardGame;

class Deck {
    public $cards;

    public function __construct() {
        $this->cards = [];
        $suits = ['hearts', 'diamonds', 'spades', 'clubs'];
        foreach ($suits as $suit) {
            for ($rank = 1; $rank <= 13; $rank++) {
                $card = new Card($suit, $rank);
                $this->cards[] = $card;
            }
        }
    }

    public function count() {
        return count($this->cards);
    }

    public function shuffle() {
        shuffle($this->cards);
    }

    public function draw($n = 1) {
        $cards_to_draw = array_slice($this->cards, -$n, $n);
        $this->cards = array_slice($this->cards, 0, -$n);
        return $cards_to_draw;
    }
}