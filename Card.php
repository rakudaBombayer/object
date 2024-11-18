<?php
    // カードについての処理
    class Card {
        private $suit;
        private $rank;
        private $strength;
        // 上書きする
        public function __construct($suit, $rank, $strength) {
            $this->suit = $suit;
            $this->rank = $rank;
            $this->strength = $strength;
        }
        // 何のカードか出力
        public function __toString() {
            return $this->suit . 'の' . $this->rank;
        }
        public function getStrength() {
            return $this->strength;
        }
    }
    // var_dump($suite);
?>