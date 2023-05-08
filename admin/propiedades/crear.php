<?php
    require "../../includes/app.php";

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;  
    
    estaAuntenticado();
    $propiedad = new Propiedad;
    
    //Consulta para obtener lo vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado_consulta = mysqli_query($db, $consulta);
    // Obteniendo el arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Este codigo se ejecuta despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        //Creando una nueva instancia
        $propiedad = new Propiedad($_POST["propiedad"]);

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            //Realiza un resize a la imagen con intervention
            $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
            // Seteamos la imagen
            $propiedad->setImagen($nombreImagen);
        }
        
        $errores = $propiedad->validarErrores();
        
        //Revisamos si el array de errores esta vacio
        if(empty($errores)) {
            //Creamos la carpeta para subir imagenes 
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
    
            //Guardamos la imagen en el servidor 
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            //Guardar en la base de datos
            $resultado = $propiedad->guardar();

            if ($resultado) {
                header("Location: http://localhost/Bienes_raices/admin?resultado=1");
                exit();
            }
        }
    }
    incluirTemplates("header");
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/Bienes_raices/admin/" class="boton boton-verde">Volver</a>
        <!-- Alerta de errores -->
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach;?>
        <!-- Fin Alerta Errores -->
        <form class="formulario" method="POST" action="/Bienes_raices/admin/propiedades/crear.php" enctype="multipart/form-data">

            <?php include "../../includes/templates/formulario_propiedades.php"?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php incluirTemplates("footer");?>
