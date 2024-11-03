<?php
//Aicina ha de ser el fitxer de les dades
/*
return [
    'host' => 'dbhost',
    'dbname'=> '4ratlla',
    'username'=> 'root',
    'password'=> '1234'
];
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';
use AJoc4enRatlla\Models\Empleado;

try {
    //Dades de la BD
    $dsn = 'mysql:host=db;dbname=pruebadb'; 
    $usuari = 'root';
    $contra = '1234';
    $pdo = new PDO($dsn, $usuari, $contra);
    echo 'Conexion establecida correctamente';
} catch (PDOException $e) {
    echo 'Error! ' . $e->getMessage();
    exit();
}


//Try catch per si fall algo
try {
    //Select en base de datos

    $sql = 'SELECT * FROM employers';

    $stmnt = $pdo->prepare($sql);
    $stmnt->execute();
    $result = $stmnt->fetchAll(PDO::FETCH_OBJ);
    //Una forma de mostrar els resultats mes senzilla, l'latra és la tabla que s'imprimeix acontinuació.
    
    var_dump($result);
    

    //Imprimir tabla amb les dades obtingudes
    echo '<table>';
    foreach ($result as $row) {
        echo "<tr><td>$row->name</td><td> $row->surname</td><td>$row->salary</td></tr>";
    }
    echo '</table>';


        //INSERT a la base de datos
    
    echo'INSERT';
    $name = 'pedro';
    $surname = 'sanchez castejon';
    $sou = 9000;
    $sql = 'INSERT INTO employers (name, surname, salary) VALUES (:name, :surname, :salary)';

    $stmnt = $pdo->prepare($sql);

    $stmnt->bindParam(':name', $name,);
    $stmnt->bindParam(':surname', $surname,);
    $stmnt->bindParam(':salary', $sou,);

    $stmnt->execute();
    echo $stmnt->rowCount().'rows inserted';
    

        //Buscar en la base de datos

    $sql = 'SELECT id FROM employers WHERE name=:name AND surname=:surname';
    $name = 'pedro';
    $surname = 'sanchez castejon';
    $salary = 300;
    $stmnt = $pdo->prepare($sql);
    $stmnt->bindParam(':name', $name);
    $stmnt->bindParam(':surname', $surname);
    $stmnt->execute();
    $resultid = $stmnt->fetch(PDO::FETCH_OBJ);
    var_dump($resultid);

        //Acutalizar en la base de datos

    $sql = 'UPDATE employers SET salary = :salary WHERE id=:id';
    $stmnt = $pdo->prepare($sql);
    $stmnt->bindParam(':salary', $salary);
    $stmnt->bindParam(':id', $resultid->id);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_OBJ);
    var_dump($result);

        //Eliminar de la abse de dades

    $sql = 'DELETE FROM employers WHERE id=:id';
    $stmnt = $pdo->prepare($sql);
    $stmnt->bindParam(':id', $resultid->id);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_OBJ);
    var_dump($result);
} catch (PDOException $e) {
    echo '' . $e->getMessage();
}



//De la forma comentada és com s'ha de fer

/*
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config/conection.php';
try{
    $dsn = 'mysql:host='.$conn['host'].'dbname='.$conn['dbname']; //Agafa les dades d'un fitxer apart
    $usuari = $conn['username'];
    $contra = $conn['password'];
    $pdo = new PDO($dsn, $usuari, $contra);
    echo'Conexion establecida correctamente';
}catch(PDOException $e){
    echo 'Error! '. $e->getMessage();
}
*/
