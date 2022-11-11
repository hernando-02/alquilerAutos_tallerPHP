<?php
use LDAP\Result;

require_once "conexion.php";

class ModeloCarros
{

    static public function create($tabla, $data)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(marca, modelo, placa) VALUES (:marca, :modelo, :placa)");
        $stmt->bindParam(':marca', $data['marca']);
        $stmt->bindParam(':modelo', $data['modelo']);
        $stmt->bindParam(':placa', $data['placa']);
        header('Content-type:application/json;charset=utf-8');

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;

    }

    static public function getAllCars($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        header('Content-type:application/json;charset=utf-8');

        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;

        $stmt->close();
        $stmt = null;

    }

    static public function getCarById($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        header('Content-type:application/json;charset=utf-8');

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

        $stmt->close();
        $stmt = null;
    }

    static public function deleteById($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM carros WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $statement = Conexion::conectar()->prepare("DELETE FROM carros WHERE id = :id");
        $statement->bindParam(':id', $id);

        $statement->execute();

        header('Content-type:application/json;charset=utf-8');
        if ($statement->execute()) {
            return $res;
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;

    }

    static public function updateCar($tabla, $data, $id)
    {
        $statement = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca, modelo = :modelo, placa = :placa WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':marca', $data['marca']);
        $statement->bindParam(':modelo', $data['modelo']);
        $statement->bindParam(':placa', $data['placa']);

        $statement->execute();

        header('Content-type:application/json;charset=utf-8');

        if ($statement->execute()) {
            return ModeloCarros::getCarById('carros', $id);
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;
    }
}
?>