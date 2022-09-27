<?php
// Conexión a la base de datos
try {
    $mbd = new PDO('mysql:host=localhost;dbname=alquiler_carros', 'eliot', '123eliot22*');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD']== 'GET'){
    try {
        //http://localhost/webServAlquilerAutos/car_get.php?id=1
        $statement = $mbd->prepare("SELECT * FROM carros WHERE id = ?");
        $statement->bindParam(1, $_GET['id']);
        $statement->execute();
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        $mbd = null;
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'carro' => $results
        ]);

    } catch (PDOException $e) {
        print("¡Error!: ".$e->getMessage() . "<br/>" );
        die();
    }
}

?>
