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

    public function __construct()
    {
        $this->initializeBoard();
    }

    private function initializeBoard(): void
    {
        $this->slots = [];
        for ($i = 0; $i < self::FILES; $i++) {
            $fila = array_fill(0, self::COLUMNS, 0);
            $this->slots[] = $fila;
        }
    }

    public function setMovementOnBoard(int $column, int $player): bool
    {
        for ($i = self::FILES - 1; $i >= 0; $i--) {
            if ($this->slots[$i][$column] == 0) {
                $this->slots[$i][$column] = $player;
                return true;
            }
        }
        return false;
    }

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

    public function isValidMove(int $column): bool
    {
        if ($column < 0 || $column >= self::COLUMNS) {
            return false;
        }
        return $this->slots[0][$column] == 0;
    }

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
