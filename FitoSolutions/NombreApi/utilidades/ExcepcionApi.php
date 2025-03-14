<?php

/**
 * Excepci�n personalizada para el env�o del estado
 */

class ExcepcionApi extends Exception {
    public $estado;
    public function __construct($estado, $mensaje, $codigo = 400) {
        $this->estado = $estado;
        parent::__construct($mensaje, $codigo);
    }
}
