<?php
    declare(strict_types = 1);
    $mensaje = $_GET["resultado"] ?? null;
    require "../includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($mensaje == 1): ?>
            <p class="alerta correcto"><?php echo "Todo ha salido correctamente"; ?></p>
        <?php endif ?>
        <a href="/Bienes_raices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>


<?php 
    incluirTemplates("footer");
?>
