<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
</head>

<body>
    <p><?php
        require __DIR__ . '/obtener_nota.php';
        $estudiantes = json_decode(file_get_contents("usuarios.json"), true);
        $informacion = get_user_info($estudiantes, $_SESSION['usuario']);
        if (!$informacion) {
            echo "usuario incorrecto";
            exit();
        }
        $nota = $informacion["nota"];
        $nombre = $informacion["nombre"];
        $apellido = $informacion["apellido"];
        ?></p>
    <h2>Bienvenido, <?php echo htmlspecialchars($nombre)." ".htmlspecialchars($apellido); ?>!</h2>
    <p>Esta es tu área personal para ver tu nota: <?php echo htmlspecialchars($nota); ?></p>
    <a href="logout.php">Cerrar Sesión</a>
</body>

</html>