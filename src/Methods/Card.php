<?php

namespace CardGame;

use CardGame\Interfaces\Comparable;

class Card implements Comparable {
    public $suit;
    public $rank;

    public function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function faceCard() {
        return $this->rank > 10;
    }

    public function __toString() {
        $face_cards = [
            1 => "Ace",
            11 => "Jack",
            12 => "Queen",
            13 => "King",
        ];
        $face_card_name = isset($face_cards[$this->rank]) ? $face_cards[$this->rank] : $this->rank;
        return "$face_card_name of $this->suit";
    }

    public function compareTo($other) {
        return $this->rank - $other->rank;
    }
}

?>