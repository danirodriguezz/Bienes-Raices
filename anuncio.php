<?php
    declare(strict_types = 1);
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /Bienes_raices/");
        exit;
    }
    //Base de datos
    require "includes/app.php";
    $db = conectarDB();
    //Consulta a la base de datos
    $query = "SELECT * FROM propiedades WHERE id = {$id};";
    $resultado = mysqli_query($db, $query);
    if(!$resultado->num_rows) {
        header("Location: /Bienes_raices/");
    }
    $propiedad = mysqli_fetch_assoc($resultado);
    // echo "<pre>";
    // var_dump($propiedad);
    // echo "</pre>";
    incluirTemplates("header");
?>

    <main class="contenedor seccion resumen-propiedad">
        <h1><?php echo $propiedad["titulo"]; ?></h1>
            <img loading="lazy" src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Imagen de Anuncio">
        <p class="precio">$ <?php echo $propiedad["precio"]; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad["wc"]; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad["habitaciones"]; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad["estacionamiento"]; ?></p>
            </li>
        </ul>
        <p>
            <?php echo $propiedad["descripcion"]; ?>
        </p>
    </main>


<?php 
    //Cerrar conexion
    mysqli_close($db);
    incluirTemplates("footer");
?>