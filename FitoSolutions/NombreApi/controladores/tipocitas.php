<?php

class tipocitas
{

    const TABLA = "tipocitas";
    const NOM_REG = "Tipo de cita";
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = "OK";
    const ESTADO_ERROR = "NOK";
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;
    const ESTADO_ERROR_ACCESO = 6;

    public static function get($peticion)
    {
        if (empty($peticion[0]))
            return self::obtenerDatos();
        else
            return self::obtenerDatos($peticion[0]);
    }

    public static function post($peticion)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        $result = self::guardar($datos);

        http_response_code(201);
        return [
            "estado" => self::CODIGO_EXITO,
            "mensaje" => self::NOM_REG . " guardado",
            "id_tipocita" => $result
        ];
    }

    public static function delete($peticion)
    {
        if (!empty($peticion[0])) {
            if (self::eliminar($peticion[0]) > 0) {
                http_response_code(200);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => self::NOM_REG . " eliminado correctamente"
                ];
            } else {
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El " . self::NOM_REG . " al que intentas acceder no existe", 404);
            }
        } else {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Falta id", 422);
        }
    }

    /**
     * Obtiene la colección de clientes o un solo contacto indicado por el identificador
     * @param int $id identificador del cliente (opcional)
     * @return array registros de la tabla clientes, y la primera dirección (codigo = 1)
     * @throws Exception
     */
    private static function obtenerDatos($id = NULL) {
        global $bd;
    
        try {
            if ($id === NULL) {
                // Obtener todas las categorías
                $sql = "SELECT * FROM categoria";
                $consulta = $bd->prepare($sql);
            } else {
                // Obtener una categoría específica por ID
                $sql = "SELECT * FROM categoria WHERE id_categoria = :id";
                $consulta = $bd->prepare($sql);
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            }
    
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
            if ($resultados) {
                return [
                    "estado" => self::ESTADO_EXITO,
                    "datos" => $resultados
                ];
            } else {
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "No se encontraron " . self::NOM_REG);
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Guardará un registro (nuevo o existente)
     * @param $datos contendrá los datos del registro
     * @param la función detectará de manera automática si es un INSERT o un UPDATE
     * @return devolverá el código del registro guardado
     * @throws ExcepcionApi
     */
    private static function guardar($datos) {
        global $pdo;
    
        try {
            if (isset($datos->id_categoria)) {
                // Actualizar una categoría existente
                $sql = "UPDATE categoria SET nombre_categoria = :nombre, descripcion_categoria = :descripcion WHERE id_categoria = :id";
                $consulta = $pdo->prepare($sql);
                $consulta->bindValue(':id', $datos->id_categoria, PDO::PARAM_INT);
            } else {
                // Insertar una nueva categoría
                $sql = "INSERT INTO categoria (nombre_categoria, descripcion_categoria) VALUES (:nombre, :descripcion)";
                $consulta = $pdo->prepare($sql);
            }
    
            $consulta->bindValue(':nombre', $datos->nombre_categoria, PDO::PARAM_STR);
            $consulta->bindValue(':descripcion', $datos->descripcion_categoria, PDO::PARAM_STR);
            $consulta->execute();
    
            if ($consulta->rowCount() > 0) {
                return $pdo->lastInsertId(); // Devuelve el ID del registro insertado o actualizado
            } else {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, "Error al guardar " . self::NOM_REG);
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Elimina un registro pasado por parámetro
     * @param int $id identificará el registro
     * @return devolvera un número mayor que 0 si se efectúa correctamente, y 0 en otro caso
     * @throws Exception excepcion por errores en la base de datos
     */
    private static function eliminar($id) {
        global $pdo;
    
        try {
            $sql = "DELETE FROM categoria WHERE id_categoria = :id";
            $consulta = $pdo->prepare($sql);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
    
            $cAfectadas = $consulta->rowCount();
    
            if ($cAfectadas > 0) {
                return $cAfectadas; // Devuelve el número de filas afectadas
            } else {
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "No se encontró la categoría con ID: " . $id);
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
}