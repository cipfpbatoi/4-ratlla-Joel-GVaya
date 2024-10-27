<?php
namespace App\Controllers;

use App\Models\Empleado;

class EmpleadoController {

    public function listAll(){
        $persona1 = new Empleado('Ignasi','Gomis Mullor',50);
        $persona2 = new Empleado('Juan','Segura Vasco',50);
        $persona1->setSou(2500);
        $persona2->setSou(2500);

        $empleados = [$persona1, $persona2];


        include $_SERVER['DOCUMENT_ROOT'].'/views/empleado.view.php';


    }
}