<?php
class RankingTable {
    private $players = array();
    private $results = array();

    public function __construct($players) {
        $this->players = $players;
    }

    public function recordResult($player, $score) {
        $this->results[$player][] = $score;
    }

    public function playerRank($rank) {
        arsort($this->results);
        $rankings = array();

        foreach ($this->results as $player => $scores) {
            $rankings[$player] = array(
                'total' => array_sum($scores),
                'games' => count($scores)
            );
        }

        uasort($rankings, function($a, $b) use ($rankings) {
            if ($a['total'] == $b['total']) {
                if ($a['games'] == $b['games']) {
                    return array_search($a, array_reverse($rankings)) > array_search($b, array_reverse($rankings)) ? 1 : -1;
                }
                return $a['games'] > $b['games'] ? 1 : -1;
            }
            return $a['total'] > $b['total'] ? -1 : 1;
        });

        return array_keys($rankings)[$rank - 1];
    }
}

$table = new RankingTable(array('Jan', 'Maks', 'Monika'));
$table->recordResult('Jan', 2);
$table->recordResult('Maks', 3);
$table->recordResult('Monika', 5);
echo $table->playerRank(1);
?>