<?php

namespace Joc4enRatlla\Models;


class Player
{
    private $name;      // Nom del jugador
    private $color;     // Color de les fitxes
    private $isAutomatic; // Forma de jugar (automàtica/manual)

    /*
    * Constructor de la classe Player
    */
    public function __construct($name, $color, $isAutomatic = false)
    {
        // TODO: Inicialitzar variables 
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    }

    // TODO: Getters i Setters 
    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getIsAutomatic(): bool
    {
        return $this->isAutomatic;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setColor($colour)
    {
        $this->color = $colour;
    }

    public function setIsAutomatic($isAutomatic)
    {
        $this->isAutomatic = $isAutomatic;
    }
}
