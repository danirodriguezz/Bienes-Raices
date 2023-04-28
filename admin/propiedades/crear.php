<?php
    use App\Propiedad;
    require "../../includes/app.php";
    
    estaAuntenticado();

    // Bases de Datos
    $db = conectarDB();   
    //Consulta para obtener lo vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado_consulta = mysqli_query($db, $consulta);
    // Obteniendo el arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedor_id = "";
    // Este codigo se ejecuta despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        //Creando el objeto de propiedad
        $propiedad = new Propiedad($_POST);
        
        $titulo = $propiedad->titulo;
        $precio = $propiedad->precio;
        $descripcion = $propiedad->descripcion;
        $habitaciones = $propiedad->habitaciones;
        $wc = $propiedad->wc;
        $estacionamiento = $propiedad->estacionamiento;
        $vendedor_id = $propiedad->vendedor_id;
        
        $errores = $propiedad->validarErrores();
        
        //Revisamos si el array de errores esta vacio
        if(empty($errores)) {
            //Guardar en la base de datos
            $propiedad->guardar();
            $imagen = $_FILES["imagen"];

            $carpetaImagenes = "../../imagenes/";
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
            
            $resultado = mysqli_query($db, $query);
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
            <fieldset>
                <legend>Infomación General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titutlo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>
            
            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                type="number" 
                id="habitaciones" 
                name="habitaciones" 
                value="<?php echo $habitaciones; ?>" 
                placeholder="Número Habitaciones" 
                min="1" 
                max="10">

                <label for="wc">Baños:</label>
                <input 
                type="number" 
                id="wc" 
                name="wc" 
                placeholder="Número Baños" 
                value="<?php echo $wc; ?>" 
                min="1" 
                max="10">

                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                type="number" 
                id="estacionamiento" 
                name="estacionamiento" 
                value="<?php echo $estacionamiento; ?>" 
                placeholder="Número Estacionamiento" 
                min="1" 
                max="10">
            </fieldset>
            
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado_consulta)): ?>
                    <option 
                    <?php echo $row["id"] === $vendedor_id ? "selected" : "";?> 
                    value="<?php echo $row["id"];?>"><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>


<?php incluirTemplates("footer");?>
