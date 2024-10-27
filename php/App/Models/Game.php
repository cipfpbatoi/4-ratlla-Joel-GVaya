<?php

namespace Joc4enRatlla\Models;

use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;

class Game
{
    private Board $board;
    private int $nextPlayer;
    private array $players;
    private ?Player $winner;
    private array $scores = [1 => 0, 2 => 0];

    public function __construct(Player $jugador1, Player $jugador2)
    {
        // TODO: S'han d'inicialitzar les variables tenint en compte que el array de jugador ha de començar amb l'index 1 
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->players = [1 => $jugador1, 2 => $jugador2];
        $this->winner = null;
    }

    // TODO: getters i setters

    public function getBoard()
    {
        return $this->board;
    }

    public function getNextPlayer()
    {
        return $this->nextPlayer;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function getScores(){
        return $this->scores;
    }


    public function reset(): void
    {
        $this->board = new Board();
    }
    public function play($columna)
    {
        // TODO: Realitza un moviment
        if ($this->board->isValidMove($columna)) {
            $this->board->setMovementOnBoard($columna, $this->getNextPlayer());
            $this->nextPlayer == $this->nextPlayer === 1 ? 2 : 1;
        }
    }
    /**
     * Realitza moviment automàtic
     * @return void
     */
    public function playAutomatic()
    {
        $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);

                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);
                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        $possibles = array();
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
        if (count($possibles) > 2) {
            $random = rand(-1, 1);
        }
        $middle = (int) (count($possibles) / 2) + $random;
        $inthemiddle = $possibles[$middle];
        $this->play($inthemiddle);
    }
    public function save()
    {
        $_SESSION['board'] = $this->board;
    }
    public static function restore()
    {
        if (isset($_SESSION['board'])) {
            $this->board = $_SESSION['board'];
        }
    }
}
