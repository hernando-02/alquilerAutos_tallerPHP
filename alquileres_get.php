<?php
// Conexión a la base de datos
try {
    $mbd = new PDO('mysql:host=localhost;dbname=alquiler_carros', 'eliot', '123eliot22*');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    try {
        // http://localhost/webServAlquilerAutos/alquileres_get.php
        $statement=$mbd->prepare("SELECT * from alquileres a INNER JOIN carros c on c.id = a.id ORDER BY(a.id)");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $mbd = null;
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(
            $results                    
        );
    } catch (PDOException $e) {
        //throw $th;
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}


?>