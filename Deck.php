<?php
    class Deck {
        private $cards = [];
    
        public function __construct() {
            $suits = ['スペード', 'ハート', 'ダイヤ', 'クラブ'];
            $ranks = ['A', 'K', 'Q', 'J', '10', '9', '8', '7', '6', '5', '4', '3', '2'];
            // range(開始値, 終了値, ステップ)14から-1していき2までの整数を作る
            $strengths = range(14, 2, -1);
            foreach ($suits as $suit) {
            foreach ($ranks as $index => $rank) {
                $strength = $strengths[$index]; // 強さはranksの順番に対応
                $this->cards[] = new Card($suit, $rank, $strength);
            }
        }
            shuffle($this->cards);
        }
        public function isEmpty() {
            return empty($this->cards);
        }
        // デッキからカードを一枚引く
        public function deal() {
            return array_pop($this->cards);
        }
    }
?>