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
        //code...
        // http://localhost/webServAlquilerAutos/alquiler_get.php?id=4
        $statement = $mbd->prepare("SELECT * FROM alquileres WHERE id = ?");
        $statement->bindParam(1, $_GET['id']);
        $statement->execute();
        $results = $statement->fetch(PDO::FETCH_ASSOC);

        $idPost = $results['id_auto'];
        
        $statm = $mbd->prepare("SELECT * FROM carros WHERE id = $idPost");
        $statm->bindParam(1, $_GET[$idPost]);
        $statm->execute();
        $auto = $statm->fetch(PDO::FETCH_ASSOC);


        $mbd = null;
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
                'id_alquiler' =>      $_GET['id'],
                'id_auto' =>          $results['id_auto'],
                'nombre_cliente' =>   $results['nombre_cliente'],
                'email_cliente' =>    $results['email_cliente'],
                'nombre_prestador' => $results['nombre_prestador'],
                'hora_inicio' =>      $results['hora_inicio'],
                'fecha_devolucion' => $results['fecha_devolucion'],
                'km_recorridos' =>    $results['km_recorridos'],
                'precio' =>           $results['precio'],
                'auto_alquilado'=>    $auto
        ]);

    } catch (PDOException $e) {
        print("¡Error!: ".$e->getMessage() . "<br/>" );
        die();
    }
}

?>
