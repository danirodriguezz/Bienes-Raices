<?php
    declare(strict_types = 1);
    //Importar la conexion
    require "../includes/config/database.php";
    $db = conectarDB();
    //Escribir el Query
    $query = "SELECT * FROM propiedades";
    //Consultar a la BD
    $resultado = mysqli_query($db, $query);
    //Muestra de mensaje adicional
    $mensaje = $_GET["resultado"] ?? null;

    //Eliminar anuncio
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            //Eliminar archivo
            $query = "SELECT imagen FROM propiedades WHERE id = {$id};";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            if($propiedad["imagen"]) {
                unlink("../imagenes/" . $propiedad["imagen"]);
            }
            //Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = {$id};";
            $resultado = mysqli_query($db, $query);
            if($resultado) {
                header("Location: /Bienes_raices/admin/?resultado=3");
            }
        }
    }
    require "../includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if(intval($mensaje) === 1): ?>
            <p class="alerta correcto">Anuncio creado correctamente</p>
        <?php elseif(intval($mensaje) === 2):?>
            <p class="alerta correcto">Anuncio actualizado correctamente</p>
        <?php elseif(intval($mensaje) === 3):?>
            <p class="alerta aviso">Anuncio eliminado correctamente</p>
        <?php endif; ?>
        <a href="/Bienes_raices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($propiedad = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $propiedad["id"]; ?></td>
                    <td><?php echo $propiedad["titulo"]; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Imagen de Propiedad" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad["precio"]; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad["id"]; ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="./propiedades/actualizar.php?id=<?php echo $propiedad["id"]; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>


<?php 
    //Cerrar Conexion
    mysqli_close($db);
    incluirTemplates("footer");
?>
