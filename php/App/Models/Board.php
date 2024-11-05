<?php

namespace Joc4enRatlla\Models;

class Board
{
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private array $slots; // graella
    /*
    * Constructor de la classe Board
    */
    public function __construct()
    {
        $this->initializeBoard();
    }

    /*
    * Getter per obtindre la graella
    * @return array
    */
    public function getSlots(): array
    {
        return $this->slots;
    }
    /*
    * Metode per inicialitzar el tauler
    */
    private function initializeBoard(): void
    {
        $this->slots = [];
        for ($i = 1; $i <= self::FILES; $i++) {
            $fila = array_fill(0, self::COLUMNS, 0);
            $this->slots[] = $fila;
        }
    }

    /*
    * Metode per fer un moviment en el tauler
    * Reb en quina columna es fa el moviment y el jugador que l'ha fet
    * recorre l'array des de l'ultima fila cap a munt per saber si pot fer el moviment, si pot el fa y si no retorna null
    * @return la posició en la que s'ha fet el moviment
    */
    public function setMovementOnBoard(int $column, int $player): ?array
    {
        $columna = $column -1;
        for ($i = self::FILES; $i >= 0; $i--) {
            // Comproba si la posicio esta buida
            if (isset($this->slots[$i][$columna]) && $this->slots[$i][$columna] == 0) {
                $this->slots[$i][$columna] = $player;
                return [$i, $columna];
            }
        }
        // Si la columna esta plena
        return [1, 1];
    }

    /*
    * Metode per comprobar si hi ha un guañador
    * reb les coordenades de l'ultim moviment fet y des d'ahi comprova si hi han 4 juntes
    * @return boolean. Si hi ha guañador o no
    */
    public function checkWin(array $coord): bool
    {
        $row = $coord[0];
        $col = $coord[1];
        $player = $this->slots[$row][$col];

        foreach (self::DIRECTIONS as $direction) {
            $count = 1;
            foreach ([-1, 1] as $dirMultiplier) {
                $dRow = $direction[0] * $dirMultiplier;
                $dCol = $direction[1] * $dirMultiplier;

                $r = $row + $dRow;
                $c = $col + $dCol;

                while ($r >= 0 && $r < self::FILES && $c >= 0 && $c < self::COLUMNS && $this->slots[$r][$c] == $player) {
                    $count++;
                    if ($count >= 4) {
                        return true;
                    }
                    $r += $dRow;
                    $c += $dCol;
                }
            }
        }
        return false;
    }
    /*
    * Metode per comprovar si el moviemnt es valid
    * Comprova que la columna tinga espai y que existeixca
    * @return boolean. Si es pot realitzar el moviment o no
    */
    public function isValidMove(int $column): bool
    {
        if ($column < 0 || $column >= self::COLUMNS) {
            return false;
        }

        return $this->slots[0][$column] == 0;
    }
    /*
    * Metode per comprovar si la taula esta plena
    * @return boolean. Si la taula esta plena o no
    */
    public function isFull(): bool
    {
        foreach ($this->slots[0] as $slot) {
            if ($slot == 0) {
                return false;
            }
        }
        return true;
    }
}
