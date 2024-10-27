<?php
include_once __DIR__ .'/../vendor/autoload.php';

use App\Controllers\EmpleadoController;

$controller = new EmpleadoController();
$controller->listAll();