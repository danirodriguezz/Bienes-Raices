<?php
    declare(strict_types = 1);
    require "../includes/app.php";
    estaAuntenticado();
    
    use App\Propiedad;

    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();

    $mensaje = $_GET["resultado"] ?? null;

    //Eliminar anuncio
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            $propiedad = Propiedad::find($id);
            //Eliminar archivo
            $propiedad->eliminar();
        
            if($propiedad["imagen"]) {
                unlink("../imagenes/" . $propiedad["imagen"]);
            }
            
        }
    }
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
                <?php foreach( $propiedades as $propiedad ): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de Propiedad" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="./propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>


<?php 
    //Cerrar Conexion
    mysqli_close($db);
    incluirTemplates("footer");
?>
