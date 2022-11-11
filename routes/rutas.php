<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

// echo $_SERVER['REQUEST_URI'];   
// echo "<pre>"; print_r($arrayRutas); echo "<pre>";


if (count(array_filter($arrayRutas)) == 2) {
    $json = array(
        "detalle" => "no encontrado"

    );
    echo json_encode($json, true);
    return;

} else {

    if (count(array_filter($arrayRutas)) == 3) {

        if (array_filter($arrayRutas)[3] == 'carros') {

            $body = json_decode(file_get_contents("php://input"), true);

            // ? crear carro
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = array(
                    "marca" => $body['marca'],
                    "modelo" => $body['modelo'],
                    "placa" => $body['placa']
                );

                $carros = new ContrladorCarros();
                $carros->create($data);

            }

            // ? listar todos carros 
            else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $carros = new ContrladorCarros();
                $carros->getAll();
            }

        }

        if (array_filter($arrayRutas)[3] == 'alquileres') {

            // ? listar todos alquileres
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $alquileres = new ControladorAlquileres();
                $alquileres->create();
            }

            // ? listar todos alquileres
            else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $alquileres = new ControladorAlquileres();
                $alquileres->getAll();
            }

        }

        // ****** esto es para ver el reporte #################

        if (array_filter($arrayRutas)[3] == 'reportes') {

            // ** reportes
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                // ****** esto es para ver el reporte
            }
        }

    } else {
        if (array_filter($arrayRutas)[3] == "carros" && is_numeric(array_filter($arrayRutas)[4])) {

            // ? obtener un carro por id
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $carros = new ContrladorCarros();
                $carros->getById(array_filter($arrayRutas)[4]);
            }


        }

        if (array_filter($arrayRutas)[3] == "update-car" && is_numeric(array_filter($arrayRutas)[4])) {

            $body = json_decode(file_get_contents("php://input"), true);
            // ? eliminar un carro por id            
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = array(
                    "marca" => $body['marca'],
                    "modelo" => $body['modelo'],
                    "placa" => $body['placa']
                );

                $carros = new ContrladorCarros();
                $carros->updateById($data, array_filter($arrayRutas)[4]);
            }
        }
    }

}