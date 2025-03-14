<?php

class conecta {

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = "OK";
    const ESTADO_ERROR = "NOK";
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    public static function get($peticion) {
        $par = explode("/", $_SERVER['QUERY_STRING']);
        unset($par[0]);
        $par = implode("/", $par);
        if ($par == "") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Acceso no válido", 422);
        } else {
            return self::obtenerDatos($par);
        }
    }

    /**
     * Permite el acceso a la API si la contraseña es correcta
     * @param $cred credenciales
     * @return array estado conexión
     * @throws Exception
     */
    private static function obtenerDatos($cred) {
        global $pdo;

        if ($cred != sha1("MisCredenciales")) throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Acceso no válido", 422);
        return [
            "estado" => self::ESTADO_EXITO,
            "mensaje" => "Acceso correcto"
        ];
    }

    private static $pdo = null;

    public static function conectar() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=tiendaFito', 'usuario', 'contraseña');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, "Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    // ... (resto del código)
}
