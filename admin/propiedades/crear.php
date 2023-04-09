<?php
    declare(strict_types = 1);
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
    $creado = date("Y/m/d");
    // Este codigo se ejecuta despues de que el usuario envie el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $titulo = $_POST["titulo"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripción"];
        $habitaciones = $_POST["habitaciones"];
        $wc = $_POST["wc"];
        $estacionamiento = $_POST["estacionamientos"];
        $vendedor_id = $_POST["vendedor"];
        if(!$titulo) {
            $errores[] = "El titulo es obligatorio";
        }
        if(!$precio) {
            $errores[] = "El precio es obligatorio";
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
        if(empty($errores)) {
            //  Insertar en la base de datos
            $query = "INSERT INTO propiedades (vendedor_id, titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado)
            VALUES('$vendedor_id', '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado');";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header("Location: /Bienes_raices/admin/index.php");
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
        <form class="formulario" method="POST" action="/Bienes_raices/admin/propiedades/crear.php">
            <fieldset>
                <legend>Infomación General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titutlo Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

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
