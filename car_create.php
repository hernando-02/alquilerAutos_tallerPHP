<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=alquiler_carros', 'eliot', '123eliot22*');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$body = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $statement = $mbd->prepare("INSERT INTO carros(marca, modelo, placa) VALUES (:marca, :modelo, :placa)");
        // esto es para crar por form-data
        // $statement->bindParam(':marca', $_POST['marca']);
        // $statement->bindParam(':modelo', $_POST['modelo']);
        // $statement->bindParam(':placa', $_POST['placa']);

        // esto es para crear desde el body
        $statement->bindParam(':marca', $body['marca']);
        $statement->bindParam(':modelo', $body['modelo']);
        $statement->bindParam(':placa', $body['placa']);
        // Insertar
        $statement->execute();

        $idPost = $mbd->lastInsertId();
        // Retornamos resultados
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([            
            'id' => $idPost,
            'marca'=>$body['marca'],
            'modelo'=>$body['modelo'],  
            'placa'=>$body['placa']   
        ]);
    
    } catch (PDOException $e) {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'error' => [
                'codigo' => $e->getCode(),
                'mensaje' => $e->getMessage()
            ]
        ]);
    }
}

?>