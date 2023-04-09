<?php
    // Bases de Datos
    require "../../includes/config/database.php";
    $db = conectarDB();   
    //Consulta para obtener lo vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado_consulta = mysqli_query($db, $consulta);
    // Arreglo con mensajes de errores
    $errores = [];
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedor_id = "";
    // Este codigo se ejecuta despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // var_dump($imagen["name"]);
        // exit;
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";
        $titulo = mysqli_real_escape_string( $db, $_POST["titulo"] );
        $precio = mysqli_real_escape_string( $db, $_POST["precio"] );
        $descripcion = mysqli_real_escape_string( $db, $_POST["descripción"] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST["habitaciones"] );
        $wc = mysqli_real_escape_string( $db, $_POST["wc"] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST["estacionamientos"] );
        $vendedor_id = mysqli_real_escape_string( $db, $_POST["vendedor"] );
        $creado = date("Y/m/d");
        $imagen = $_FILES["imagen"];
        if(!$titulo) {
            $errores[] = "El titulo es obligatorio";
        }
        if(!$precio || $precio > 99999999 ) {
            $errores[] = "El apartado de precio esta mal introducido";
        }
        if(strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatorio y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones) {
            $errores[] ="Debe introducir mínimo 1 habitación";
        }
        if(!$wc) {
            $errores[] = "El wc es obligatorio";
        }
        if(!$estacionamiento) {
            $errores[] = "El estacionamiento es obligatorio";
        }
        if(!$vendedor_id) {
            $errores[] = "Eliga un vendedor";
        }
        if(!$imagen["name"]) {
            $errores[] = "Es obligatorio las imagenes";
        }
        //Validar por tamaño de fotos(100Kb MAX)
        $medida = 40000000;
        if($imagen["size"] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }

        if(empty($errores)) {
            $carpetaImagenes = "../../imagenes/";
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
            //  Insertar en la base de datos
            $query = "INSERT INTO propiedades (vendedor_id, titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado)
            VALUES('$vendedor_id', '$titulo', '$precio','$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado');";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header("Location: http://localhost/Bienes_raices/admin?resultado=1");
                exit();
            }
        }
    }
    require "../../includes/funciones.php";
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
                <textarea id="descripcion" name="descripción"><?php echo $descripcion; ?></textarea>
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
                name="estacionamientos" 
                value="<?php echo $estacionamiento; ?>" 
                placeholder="Número Estacionamiento" 
                min="1" 
                max="10">
            </fieldset>
            
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor">
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
