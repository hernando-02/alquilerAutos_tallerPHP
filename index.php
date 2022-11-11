<?php

require_once "controller/rutas_controlador.php";
require_once "controller/carros_controlador.php";
require_once "controller/alquileres_controlador.php";
require_once "models/carros_modelo.php";
require_once "models/alquileres_modelo.php";

$rutas = new ControladorRutas();
$rutas->inicio();