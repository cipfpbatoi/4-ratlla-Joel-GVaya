<?php

namespace Joc4enRatlla\Exceptions;

class Exception extends \Exception {
    public function __construct($message, \Exception $previous = null) {
        parent::__construct($message, 0, $previous);
    }

    public function error() {
        return "Error!: " . $this->getMessage();
    }
}
