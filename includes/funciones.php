<?php
require "app.php";
function incluirTemplates( string $nombre, bool $inicio = false) {
    // echo TEMPLATES_URL . "/{$nombre}.php";
    include TEMPLATES_URL . "/{$nombre}.php";
};