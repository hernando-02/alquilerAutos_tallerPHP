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
        // http://localhost/webServAlquilerAutos/alquiler_create.php
        $statement = $mbd->prepare(
            "INSERT INTO alquileres(id_auto, nombre_cliente, email_cliente, nombre_prestador, hora_inicio, fecha_devolucion, km_recorridos,precio)
             VALUES (:id_auto, :nombre_cliente, :email_cliente,:nombre_prestador, :hora_inicio, :fecha_devolucion, :km_recorridos, :precio)");

        // esto es para crear desde el body
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
        
        $idAlquiler =$mbd->lastInsertId();
        $idPost = $body['id_auto'];
        
        $statm = $mbd->prepare("SELECT * FROM carros WHERE id = $idPost");
        $statm->bindParam(1, $_GET[$idPost]);
        $statm->execute();
        $auto = $statm->fetch(PDO::FETCH_ASSOC);

        // Retornamos resultados
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([            
            'id_alquiler'=>      $idAlquiler,
            'id_auto'=>          $body['id_auto'],
            'nombre_cliente'=>   $body['nombre_cliente'],
            'email_cliente'=>    $body['email_cliente'],
            'nombre_prestador'=> $body['nombre_prestador'],
            'hora_inicio'=>      $body['hora_inicio'],
            'fecha_devolucion'=> $body['fecha_devolucion'],
            'km_recorridos'=>    $body['km_recorridos'],
            'precio'=>           $body['precio'],
            'carro_alquilador'=> $auto
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
//     "id_auto": 4,
//     "nombre_cliente": "Carmen",
//     "email_cliente": "Carmen@correo.com",
//     "nombre_prestador": "Cajlos Acbecto",
//     "hora_inicio": "2022-09-21 12:00:59",
//     "fecha_devolucion": "2022-09-26",
//     "km_recorridos": 96,
//     "precio": 700000
// }

?>