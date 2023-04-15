<?php 
    //Importar la base de datos
    require "includes/config/database.php";
    $db = conectarDB();
    //Consultar la base de datos
    $query ="";
    if($limite) {
        $query = "SELECT * FROM propiedades LIMIT {$limite};";
    } else {
        $query = "SELECT * FROM propiedades;";
    }
    
    //Leer los resultados
    $resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
        <img loading="lazy" src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Anuncio">
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad["titulo"];?></h3>
            <p><?php echo $propiedad["descripcion"];?></p>
            <p class="precio">$ <?php echo $propiedad["precio"];?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad["wc"];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad["habitaciones"];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad["estacionamiento"];?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad["id"];?>" class="boton boton-amarillo">
                Ver propiedad
            </a>
        </div><!-- contenido-anuncio -->
    </div><!--anuncio-->
    <?php endwhile;?>
</div><!--contenedor-anuncios-->

<?php
    //Cerrar la conexion
    mysqli_close($db);
?>