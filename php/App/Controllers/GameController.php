<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Models\LogsGame;
use Joc4enRatlla\Exceptions\Exception;



/*
* Class GameController
* És l'encarregat de la llògica del joc, la creacio dels jugadors y el control de les accions que es duen a terme durant el joc
*/

class GameController
{
    private Game $game;
    private LogsGame $logsGame;

    private Exception $exception;

    /*
    * Constructor de GameController
    * 
    * Si hi ha una sessió ya creada la carrega, si no crea una nova sessio junt als jugadors
    */
    public function __construct($request)
    {

        if (isset($_SESSION['game'])) {
            $this->game = Game::restore();
            $this->logsGame = new LogsGame();
            $this->logsGame->logInfo('Partida restaurada');
        } else {
            try {
                echo $request['name'];
                $this->logsGame = new LogsGame();
                $player1 = new Player($request['name'], $request['color']);
                $player2 = new Player('maquina', 'rojo', true);
                $this->game = new Game($player1, $player2);
                $this->game->save();
                $this->logsGame->logInfo('Partida nueva creada');
                $this->exception = new Exception('No se pudo iniciar el juego');
            } catch (Exception $e) {
                $this->logsGame->logError('' . $e->getMessage());
            }
        }

        if ($request) {
            $this->play($request);
        }
    }


    /*
    * Encarregat de realitzar els moviments en la taula, reiniciar el joc i acabarlo.
    * reb l'accio que vol realitzar el jugador
    */
    public function play(array $request = [])
    {
        try {
            if (isset($request['columna'])) {
                $coord = $this->game->play($request['columna']);
                $this->logsGame->logInfo('El jugador ' . $this->game->getNextPlayer() . ' ha hecho una jugada en la columna ' . $coord[1] . ' y la fila ' . $coord[0]);
                $coord = $this->game->playAutomatic();
                $this->logsGame->logInfo('El jugador ' . $this->game->getNextPlayer() . ' ha hecho una jugada en la columna ' . $coord[1] . ' y la fila ' . $coord[0]);
                $this->game->save();
            } else if (isset($request['reset'])) {
                $this->game->reset();
                $this->game->save();
                $this->logsGame->logInfo('Se ha reiniciado la partida');
            } else if (isset($request['exit'])) {
                $this->logsGame->logInfo('Se va a eliminar la partida');
                session_destroy();
                session_unset();
                loadView('jugador');
                exit;
            }

            $board = $this->game->getBoard();
            $players = $this->game->getPlayers();
            $winner = $this->game->getWinner();
            $scores = $this->game->getScores();

            loadView('index', compact('board', 'players', 'winner', 'scores'));
            $this->exception = new Exception('No se pudo realizar la accion');
        } catch (Exception $e) {
            $this->logsGame->logError('' . $e->getMessage());
        }
    }
}
