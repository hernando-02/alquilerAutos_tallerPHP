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

        // selecciono el alquiler a borrar
        // http://localhost/webServAlquilerAutos/alquiler_delete.php
        $stmt = $mbd->prepare("SELECT * FROM alquileres WHERE id = ?");
        $stmt->bindParam(1, $body['id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo($res['id_auto']);
        $idAuto = $res['id_auto'];

        // borro el alquiler por el id
        $statement = $mbd->prepare("DELETE FROM alquileres WHERE id = :id");
        $statement->bindParam(':id', $body['id']);

        $statement->execute();

        $statm = $mbd->prepare("SELECT * FROM carros WHERE id = $idAuto");
        $statm->bindParam(1, $_GET[$idAuto]);
        $statm->execute();
        $auto = $statm->fetch(PDO::FETCH_ASSOC);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'mensaje' => 'Registro eliminado satisfactoriamente',            
            'data' =>[        
                'id_alquiler'=>      $body['id'],
                'id_auto'=>          $res['id_auto'],
                'nombre_cliente'=>   $res['nombre_cliente'],
                'email_cliente'=>    $res['email_cliente'],
                'nombre_prestador'=> $res['nombre_prestador'],
                'hora_inicio'=>      $res['hora_inicio'],
                'fecha_devolucion'=> $res['fecha_devolucion'],
                'km_recorridos'=>    $res['km_recorridos'],
                'precio'=>           $res['precio'],
                'carro_alquilado'=> $auto
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