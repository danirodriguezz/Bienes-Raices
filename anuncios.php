<?php
    declare(strict_types = 1);
    require "includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Casas y Departamentos en Venta</h1>
        <?php
            include "includes/templates/anuncios.php";
        ?>
    </main>


<?php 
    incluirTemplates("footer");
?>

