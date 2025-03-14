<?php
class VistaApi {
    public function imprimir($cuerpo, $codigo = 200) {
        http_response_code($codigo);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($cuerpo, JSON_PRETTY_PRINT);
        exit;
    }
}
