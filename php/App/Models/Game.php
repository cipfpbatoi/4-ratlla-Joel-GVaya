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
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->players = [1 => $jugador1, 2 => $jugador2];
        $this->winner = null;
    }

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

    public function getScores()
    {
        return $this->scores;
    }

    public function reset(): void
    {
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->winner = null;
    }

    public function play($columna)
    {
        if ($this->winner) {
            // Si ya hay un ganador, el juego ha terminado
            return;
        }

        if ($this->board->isValidMove($columna)) {
            if ($columna != null) {
                // Realizar el movimiento
                $coord = $this->board->setMovementOnBoard($columna, $this->nextPlayer);

                // Verificar si hay un ganador después del movimiento
                if ($this->board->checkWin($coord)) {
                    $this->winner = $this->players[$this->nextPlayer];
                    $this->scores[$this->nextPlayer]++;
                } else if ($this->board->isFull()) {
                    //Logica per si el tauler esta ple i no hi han guañadors
                } else {
                    // Alternar jugador si no hay ganador
                    $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;
                }
            }
        }
    }

    /**
     * Realiza un movimiento automático para el jugador 2.
     * Evalúa posibles jugadas para ganar o bloquear al oponente.
     */
    public function playAutomatic()
    {
        $opponent = $this->nextPlayer === 1 ? 2 : 1;

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);

                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
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

    /*
    * Metode per guardar l'estat de la partida
    */
    public function save()
    {
        $_SESSION['game'] = serialize($this);
    }

    /*
    * Metode per restaurar la partida guardada
    */

    public static function restore()
    {
        if (isset($_SESSION['game']) && is_string($_SESSION['game'])) {
            return unserialize($_SESSION['game']);
        } else {
            echo 'No se ha podido restaurar sesión';
        }
    }
}
