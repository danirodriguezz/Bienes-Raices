<?php

function conectarDB() : mysqli {
    $db = mysqli_connect("localhost", "root", "", "Bienes_Raices");
    
    if (!$db) {
        echo "Error no se pudo concectar";
        exit;
    }

    return $db;
};