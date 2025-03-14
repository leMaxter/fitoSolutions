<?php
include_once("../bd.php"); 
require 'vistas/VistaApi.php';
require 'utilidades/ExcepcionApi.php';
require 'controladores/conecta.php';
require 'controladores/tipocitas.php';

const ESTADO_URL_INCORRECTA = 2;
const ESTADO_EXISTENCIA_RECURSO = 3;
const ESTADO_METODO_NO_PERMITIDO = 4;

$vista = new VistaApi();

set_exception_handler(function ($exception) use ($vista) {
    $cuerpo = array(
        "estado" => $exception->estado,
        "mensaje" => $exception->getMessage()
    );

    $vista->imprimir($cuerpo);
});

if (isset($_GET['PATH_INFO']))
    $peticion = explode('/', $_GET['PATH_INFO']);
else
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, "No se reconoce la petición");

// Obtener recurso
$recurso = array_shift($peticion);
$recursos_existentes = array('conecta', 'tipocitas');

// Comprobar el recurso
if (!in_array($recurso, $recursos_existentes)) {
    throw new ExcepcionApi(ESTADO_EXISTENCIA_RECURSO, "No se reconoce el recurso al que intentas acceder");
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);

// Filtrar 
switch ($metodo) {
    case 'get':
    case 'post':
    case 'delete':
        if (method_exists($recurso, $metodo)) {
            $respuesta = call_user_func(array($recurso, $metodo), $peticion);
            $vista->imprimir($respuesta);
            break;
        }
    default:
        $cuerpo = [
            "estado" => ESTADO_METODO_NO_PERMITIDO,
            "mensaje" => "Método no permitido"
        ];
        $vista->imprimir($cuerpo);
}