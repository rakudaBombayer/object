<?php
    class Player {
    public $name;
    private $hand = [];
    private $takeHand = [];

    public function __construct($name) {
        $this->name = $name;
    }

    // プレイヤーがカードを手札に追加する
    public function draw(Card $card) {
        $this->hand[] = $card;
    }

    // プレイヤーがカードを出す処理
    public function playCard() {
        //手札があれば
        if (!$this->isHandEmpty()) {
            return array_pop($this->hand);
        }
        return null; // 手札が空の場合はnullを返す
    }

    // 手札を返す
    public function getHand() {
        return $this->hand;
    }

    // 手札が空かどうかをチェック
    public function isHandEmpty() {
        return empty($this->hand);
    }

    // 相手のカードを手札に加える
    public function addHand($cards) {
        foreach ($cards as $card) {
            $this->takeHand[] = $card;
        }
    }
    
    // プレイヤーの手札の枚数を数える
    public function countHand() {
        return count($this->takeHand);
    }
}

?>