<?php
    require "../../includes/app.php";
    use App\Vendedor;
    estaAuntenticado();

    //Validar el id 
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /Bienes_raices/admin");
        exit;
    }
    $vendedor = Vendedor::find($id);
    //Arreglo con los mensajes de errores
    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $args = $_POST["vendedor"];
        //Sincronizamos el objeto que tengo en la clase con lo que envia el usuraio
        $vendedor->sincronizar($args);
        //Validamos los errores 
        $errores = $vendedor->validarErrores();

        if(empty($errores)) {
            //Actualizamos los datos
            $vendedor->guardar();
        }
    }
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>
        <a href="/Bienes_raices/admin/" class="boton boton-verde">Volver</a>
        <!-- Alerta de errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach;?>
        <!-- Fin Alerta Errores -->
        <form class="formulario" method="POST">
            <?php include "../../includes/templates/formulario_vendedores.php"?>
            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplates("footer");?>
