<?php
    declare(strict_types = 1);
    require "includes/config/database.php";
    $db = conectarDB();
    $error = "";
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $password = mysqli_real_escape_string($db, $_POST["password"]);
            // $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)); 
            // if(!$email || !$password) {
                // $errores[] = "Tienes un error en el usario o contraseña";
            // }
        if (!$email || !$password) {
            $error = "Usuario o contraseña incorrectos";
        } else {
            $email = mysqli_real_escape_string($db, $email);
        }
        if(empty($errores)) {
            // Revisaremos si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}';";
            $resultado = mysqli_query($db, $query);
            if($resultado->num_rows) {
                $usuario =  mysqli_fetch_assoc($resultado);
                // var_dump($usuario["password"]);
                //Verificar que es correcto el password
                $auth = password_verify($password, $usuario["password"]);
                if($auth) {
                    //El usuario esta autenticado
                    session_start();
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;
                    header("Location: http://localhost/Bienes_raices/admin/");
                } else {
                    $error = "Usuario o contraseña incorrectos";
                }
            } else {
                $error = "Usuario o contraseña incorrectos";
            }

        }
    }
    
    require "includes/funciones.php";
    incluirTemplates("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php if(!empty($error)): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>
                <label for="emial">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton-verde">
        </form>
    </main>

<?php 
    incluirTemplates("footer");
?>

