<?php
    declare(strict_types = 1);
    require "../includes/app.php";
    estaAuntenticado();
    //Importar las clases
    use App\Propiedad;
    use App\Vendedor;
    // Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    //Obteniendo el resultado
    $resultado = $_GET["resultado"] ?? null;
    //Eliminar anuncio
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            $tipo = $_POST["tipo"];
            //Validamos que existe el tipo
            if(validarTipoContenido($tipo)) {
                if($tipo === "propiedad") {
                    //Eliminando propiedad
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                } else if($tipo === "vendedor") {
                    //Eliminando vendedor
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje):?>
                <p class="alerta correcto"><?php echo sanitizar($mensaje) ?></p>
        <?php endif ?>
        <a href="/Bienes_raices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/Bienes_raices/admin/vendedores/crear.php" class="boton boton-amarillo-inline-block">Nuevo Vendedor</a>
        <h2>Propiedades</h2>
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
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/Bienes_raices/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $vendedores as $vendedor ): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/Bienes_raices/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>


<?php 
    incluirTemplates("footer");
?>
