<?php

use Joc4enRatlla\Models\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    private Board $board;

    protected function setUp(): void
    {
        $this->board = new Board();
    }

    public function testInitializeBoard()
    {
        $slots = $this->board->getSlots();
        $this->assertCount(Board::FILES, $slots); //Comproba el numero de files
        foreach ($slots as $row) {
            $this->assertCount(Board::COLUMNS, $row); //Comproba el numero de columnes
            $this->assertEquals(array_fill(0, Board::COLUMNS, 0), $row); //Comproba el valor de les casilles
        }
    }

    public function testSetMovementOnBoard()   //Comprova que els moviments siguen correctes
    {
        $this->assertSame([5, 0], $this->board->setMovementOnBoard(1, 1)); 
        $this->assertSame([4, 0], $this->board->setMovementOnBoard(1, 2));
        $this->assertSame([3, 0], $this->board->setMovementOnBoard(1, 1));
        $this->assertSame([5, 1], $this->board->setMovementOnBoard(2, 1));
        $this->assertSame([2, 0], $this->board->setMovementOnBoard(1, 2));
    }

    public function testSetMovementOnFullColumn()
    {
        //Plena la primera columna
        for ($i = 0; $i < Board::FILES; $i++) {
            $this->board->setMovementOnBoard(1, 1);
        }
        //Comprova si pot fer el moviment estant la columna plena
        $this->assertNull($this->board->setMovementOnBoard(1, 1));
    }

    public function testCheckWin()
    {
        $this->board->setMovementOnBoard(1, 1);
        $this->board->setMovementOnBoard(2, 1);
        $this->board->setMovementOnBoard(3, 1);
        $this->assertTrue($this->board->checkWin($this->board->setMovementOnBoard(4, 1))); //Ha de retornar true
    }

    public function testIsValidMove()
    {
        $this->assertTrue($this->board->isValidMove(0));  //Valid
        $this->assertFalse($this->board->isValidMove(-1)); //Invalid
        $this->assertFalse($this->board->isValidMove(7));  //Invalid
    }

}
