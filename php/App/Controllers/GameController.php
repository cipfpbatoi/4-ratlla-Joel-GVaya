<?php
namespace Joc4enRatlla\Controllers;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;


class GameController
{
 private Game $game;

// Request és l'array $_POST

public function __construct($request=null)
{
    if(isset($_SESSION['board'])){
        $this ->game = $_SESSION['board'];
    }

    $this->play($request);

}

public function play(Array $request)  
{
    // TODO : Gestió del joc. Ací es on s'ha de vore si hi ha guanyador, si el que juga es automàtic  o manual, s'ha polsat reiniciar...



    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();

    loadView('index',compact('board','players','winner','scores'));
 }
}