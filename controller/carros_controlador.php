<?php
class ContrladorCarros
{

    // * CREATE CAR
    public function create($data)
    {
        // validad marca que solo sean letras
        if (isset($data['marca']) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $data['marca'])) {
            $json = array(
                "detalle" => " error, la marca es solo letras"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;
        }
        // validad model que solo tenga numeros
        else if (isset($data['modelo']) && !is_numeric($data['modelo'])) {
            $json = array(
                "detalle" => " error, el modelos es solo numeros"

            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;
        } else if (isset($data['placa']) && !preg_match('/^[-$a-zA-Z-1-9]+$/', $data['placa'])) {
            $json = array(
                "detalle" => " error, solo se permiten letras, numeros y el guion(-)"

            );
            echo json_encode($json, true);
            return;
        }
        // validar placa, que tenga numeros, letrar y guion
        else {
            $carros = ModeloCarros::create("carros", $data);
            if ($carros == 'ok') {
                // $json = array(
                //     // "status" => "ok",
                //     $data
                // );
                // echo json_encode($json, true);
                header('Content-type:application/json;charset=utf-8');
                echo json_encode($data, true);
                return;
            }
        }
        // validar correo
        // if (isset($data["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([ . ][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.] 
        // [a-zA-Z0-9_]+)*[•][a-zA-Z]{2,4}$/', $data["email"])) {}


    }

    // * GET ALL CARS
    public function getAll()
    {
        $carros = ModeloCarros::getAllCars('carros');
        // $json = array(
        //     "carros" => $carros
        // );
        echo json_encode($carros);
        return;

    }

    // * GET CAR BY ID
    public function getById($id)
    {
        $carro = ModeloCarros::getCarById('carros', $id);
        echo json_encode($carro);
        return;
    }

    // * ELIMINAR CARRO
    public function deleteById($id)
    {
        $carro = ModeloCarros::deleteById("carros", $id);
        echo json_encode([
            'mensaje' => 'Registro eliminado satisfactoriamente',
            'data' => $carro
        ]);
        return;


    }

    // * ELIMINAR CARRO
    public function updateById($data, $id)
    {
        $carro = ModeloCarros::updateCar("carros", $data, $id);
        echo json_encode([
            'mensaje' => 'Registro actualizado satisfactoriamente',
            'data' => $carro
        ]);
        return;


    }
}

?>