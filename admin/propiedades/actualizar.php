<?php
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    require "../../includes/app.php";
    
    estaAuntenticado();
    
    //Validar el id 
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /Bienes_raices/admin");
        exit;
    }

    //Consulta para obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //Consulta para obtener lo vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado_consulta = mysqli_query($db, $consulta);
    
    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Este codigo se ejecuta despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        //Asignamos los atributos
        $args = $_POST["propiedad"];
        //Sincronizando los nuevos datos con los que estan en memoria 
        $propiedad->sincronizar($args);
        //Validando errores
        $errores = $propiedad->validarErrores();
        
        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            //Realiza un resize a la imagen con intervention
            $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
            // Seteamos la imagen
            $propiedad->setImagen($nombreImagen);
        }

        
        if(empty($errores)) {
            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                //Almacenamos la imagen 
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            //  Actualizamos los datos
            $propiedad->guardar();
        }
    }
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/Bienes_raices/admin/" class="boton boton-verde">Volver</a>
        <!-- Alerta de errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach;?>
        <!-- Fin Alerta Errores -->

        <!-- Inicio del Formulario -->
        <form class="formulario" method="POST"  enctype="multipart/form-data">
            
            <?php include "../../includes/templates/formulario_propiedades.php" ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
        <!-- Fin del Formulario -->
    </main>


<?php incluirTemplates("footer");?>
