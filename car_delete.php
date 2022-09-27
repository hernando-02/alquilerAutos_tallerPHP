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
        // http://localhost/webServAlquilerAutos/car_delete.php
        $stmt = $mbd->prepare("SELECT * FROM carros WHERE id = ?");
        $stmt->bindParam(1, $body['id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $statement = $mbd->prepare("DELETE FROM carros WHERE id = :id");
        $statement->bindParam(':id', $body['id']);

        $statement->execute();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'mensaje' => 'Registro eliminado satisfactoriamente',            
            'data' => $res
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