<?php


try {
    $bd = new PDO("mysql:host=localhost;dbname=tiendaFito;charset=utf8", "root", "");
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $p) {
    echo "Se ha lanzado la excepción " . $p->getMessage() . "<br />";
    exit;
}
?>