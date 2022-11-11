<?php
class ControladorAlquileres
{

    public function create()
    {
        $json = array(
            "detalle" => "Estas controller ALQUILERES"
        );
        echo json_encode($json, true);
        return;
    }

    public function getAll()
    {
        $json = array(
            "detalle" => "estas en el controlador de listar los alquileres"
        );
        echo json_encode($json, true);
        return;
    }
}

?>