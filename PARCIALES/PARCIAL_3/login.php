<?php
session_start();
include 'config_sesion.php';
// Si ya hay una sesión activa, redirigir al panel
if (isset($_SESSION['usuario'])) {
    header("Location: panel.php");
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Error de validación CSRF");
    }
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // En un caso real, verificaríamos contra una base de datos
    $estudiantes = json_decode(file_get_contents("usuarios.json"), true);
    function get_user_info($array, $usuario)
    {

        foreach ($array as $key => $value) {
            if ($value["usuario"] == $usuario) {
                return $value;
            }
        }
        return false;
    }
    $informacion = get_user_info($estudiantes, $usuario);
    $user = "";
    $contra = "";
    if($informacion){
        $user = $informacion["usuario"];
        $contra = $informacion["password"];

    }
    
    if(!ctype_alnum($user) || strlen($user) < 3){
        $error = "Usuario invalido";
    }


    if (!$informacion) {
        $error = "Usuario o contraseña incorrectos";
    }
    if($usuario == "profesor" && $contrasena == "1234"){
        $_SESSION['usuario'] = "profesor";
        header("Location: dash_profesor.php");
        exit(); 
    }
    if ($usuario == $user && $contrasena == $contra) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dash_estudiante.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <?php
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    ?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>

</html>