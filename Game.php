<?php
    // デッキを配る,手札で勝負させる
    require_once 'Card.php';
    require_once 'Deck.php';
    require_once 'Player.php';

    class Game {
        private $players = [];
        private $deck;
        private $playerCount = 2;

        public function __construct() {
            $this->deck = new Deck();
        }

        public function addPlayer($name) {
            // インスタンスを作った時
            $this->players[] = new Player($name);
        }
        
        public function start() {
            echo "戦争を開始します。" . PHP_EOL;
            // playerCount分だけaddPlayerする
            for ($i = 0; $i < $this->playerCount; $i++) {
                $this->addPlayer("プレイヤー" . ($i + 1));
            }
            // プレイヤーにカードを配る
            while (!$this->deck->isEmpty()) {
                foreach ($this->players as $player) {
                    if (!$this->deck->isEmpty()) {
                        // 配られたカードをプレイヤーの手札[hand]に加える
                        $player->draw($this->deck->deal());
                    }
                }
            }
            echo "カードが配られました。";
        }
        // 手札がなくなったかをチェック
        private function isGameOver() {
            foreach ($this->players as $player) {
                if (count($player->getHand()) == 0) {
                    return true;
                }
            }
            return false;
        }

        public function battle() {
            $this->start();
            $battlefield = []; // 場札を保持する配列
            
            while (!$this->isGameOver()) {
                echo "戦争！" . PHP_EOL;
                $cards = [];
                foreach ($this->players as $index => $player) {
                    if ($player->isHandEmpty()) {
                        break; // 手札が空のプレイヤーがいればループを抜ける
                    }
                    $card = $player->playCard();
                    echo "プレイヤー" . ($index + 1) . "のカードは" . $card . "です。" . PHP_EOL;
                    $cards[] = $card;
                    $battlefield[] = $card; // 場札にカードを追加
                }

                // 勝敗の決定とカードの配布
                if ($cards[0]->getStrength() > $cards[1]->getStrength()) {
                    echo "プレイヤー1が勝ちました。プレイヤー1はカードを" . count($battlefield) . "枚もらいました。" . PHP_EOL;
                    $this->players[0]->addHand($battlefield);
                    $battlefield = []; // 場札をクリア
                } elseif ($cards[0]->getStrength() < $cards[1]->getStrength()) {
                    echo "プレイヤー2が勝ちました。プレイヤー2はカードを" . count($battlefield) . "枚もらいました。" . PHP_EOL;
                    $this->players[1]->addHand($battlefield);
                    $battlefield = []; // 場札をクリア
                } else {
                    echo "引き分けです。" . PHP_EOL;
                    $battlefield = []; // 場札をクリア
                }
            }
            $this->displayResult(); // ゲーム終了時に結果を表示
        }

        private function displayResult() {
            // 手札の枚数でソート
            usort($this->players, function($a, $b) {
                return $b->countHand() - $a->countHand();
            });
            
            foreach ($this->players as $index => $player) {
                echo "プレイヤー" . ($index + 1) . "の手札の枚数は" . $player->countHand() . "枚です。" . PHP_EOL;
            }
            
            // 順位の表示
            foreach ($this->players as $index => $player) {
                echo "プレイヤー" . ($index + 1) . "が" . ($index + 1) . "位です。" . PHP_EOL;
            }
            echo "戦争を終了します。" . PHP_EOL;
        }
    }
    // var_dump($cards);
    $game = new Game();
    $game->battle();