<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMAGENES", __DIR__ . "/../imagenes/");

function incluirTemplates( string $nombre, bool $inicio = false) {
    // echo TEMPLATES_URL . "/{$nombre}.php";
    include TEMPLATES_URL . "/{$nombre}.php";
};

function estaAuntenticado() {
    session_start();
    if(!$_SESSION["login"]) {
        return header("Location: /Bienes_raices/");
    }
}

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa el HTML
function sanitizar($html) : string {
    $sanitizado = htmlspecialchars($html);
    return $sanitizado; 
}