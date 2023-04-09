<?php
    declare(strict_types = 1);
    require "../includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <a href="/Bienes_raices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>


<?php 
    incluirTemplates("footer");
?>
