<?php
    require "../../includes/app.php";
    use App\Vendedor;
    estaAuntenticado();

    $vendedor = new Vendedor;
    //Arreglo con los mensajes de errores
    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        //Creamos el objeto de vendedor
        $vendedor = new Vendedor($_POST["vendedor"]);
        //Validamos los errores
        $errores = $vendedor->validarErrores();
        //Revisamos si el array de errores esta vacio 
        if(empty($errores)) {
            $resultado = $vendedor->guardar();
            if ($resultado) {
                header("Location: http://localhost/Bienes_raices/admin?resultado=1");
                exit();
            }
        }
    }
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Registrar Vendedor</h1>
        <a href="/Bienes_raices/admin/" class="boton boton-verde">Volver</a>
        <!-- Alerta de errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach;?>
        <!-- Fin Alerta Errores -->
        <form class="formulario" method="POST" action="/Bienes_raices/admin/vendedores/crear.php">
            <?php include "../../includes/templates/formulario_vendedores.php"?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplates("footer");?>

