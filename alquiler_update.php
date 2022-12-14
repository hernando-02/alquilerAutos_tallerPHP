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
        // http://localhost/webServAlquilerAutos/alquiler_update.php
        $statement = $mbd->prepare("UPDATE alquileres 
        SET id = :id_alquiler, id_auto = :id_auto, nombre_cliente = :nombre_cliente, email_cliente = :email_cliente, nombre_prestador = :nombre_prestador, hora_inicio = :hora_inicio, fecha_devolucion = :fecha_devolucion, km_recorridos = :km_recorridos ,precio = :precio
        WHERE id = :id_alquiler");

                $statement->bindParam(':id_alquiler',               $body['id_alquiler']);
                $statement->bindParam(':id_auto',          $body['id_auto']);
                $statement->bindParam(':nombre_cliente',   $body['nombre_cliente']);
                $statement->bindParam(':email_cliente',    $body['email_cliente']);
                $statement->bindParam(':nombre_prestador', $body['nombre_prestador']);
                $statement->bindParam(':hora_inicio',      $body['hora_inicio']);
                $statement->bindParam(':fecha_devolucion', $body['fecha_devolucion']);
                $statement->bindParam(':km_recorridos',    $body['km_recorridos']);
                $statement->bindParam(':precio',           $body['precio']);
        // Insertar
        $statement->execute();

        $idPost = $body['id_auto'];
        
        $statm = $mbd->prepare("SELECT * FROM carros WHERE id = $idPost");
        $statm->bindParam(1, $_GET[$idPost]);
        $statm->execute();
        $auto = $statm->fetch(PDO::FETCH_ASSOC);


        // $idPost = $mbd->lastInsertId();
        // Retornamos resultados
        header('Content-type:application/json;charset=utf-8');
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'mensaje' => 'Registro actualizado satisfactoriamente',            
            'data' => [
                'id_alquiler' =>      $body['id_alquiler'],
                'id_auto' =>          $body['id_auto'],
                'nombre_cliente' =>   $body['nombre_cliente'],
                'email_cliente' =>    $body['email_cliente'],
                'nombre_prestador' => $body['nombre_prestador'],
                'hora_inicio' =>      $body['hora_inicio'],
                'fecha_devolucion' => $body['fecha_devolucion'],
                'km_recorridos' =>    $body['km_recorridos'],
                'precio' =>           $body['precio'],
                'auto_alquilado'=>    $auto
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

// {
//     "id_alquiler": "20",
//     "id_auto": "1",
//     "nombre_cliente": "Carmen Josefa",
//     "email_cliente": "Carmen@correo.com",
//     "nombre_prestador": "Fernando Jose hoyos",
//     "hora_inicio": "2022-09-21 12:00:59",
//     "fecha_devolucion": "2022-09-26",
//     "km_recorridos": "96",
//     "precio": "700000"
// }

?>