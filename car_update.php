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
        $statement = $mbd->prepare("UPDATE carros SET marca = :marca, modelo = :modelo, placa = :placa WHERE id = :id");
        $statement->bindParam(':id', $body['id']);
        $statement->bindParam(':marca', $body['marca']);
        $statement->bindParam(':modelo', $body['modelo']);
        $statement->bindParam(':placa', $body['placa']);
        // Insertar
        $statement->execute();

        $idPost = $mbd->lastInsertId();
        // Retornamos resultados
        header('Content-type:application/json;charset=utf-8');
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'mensaje' => 'Registro actualizado satisfactoriamente',            
            'data' => [
                'id' => $body['id'],
                'marca'=>$body['marca'],
                'modelo'=>$body['modelo'],  
                'placa'=>$body['placa']   
            ]
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