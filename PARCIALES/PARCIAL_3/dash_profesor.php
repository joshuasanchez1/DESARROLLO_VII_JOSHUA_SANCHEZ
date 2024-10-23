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
    <h2>Bienvenido profe!</h2>
    <h2>Aqui estan todas las notas: </h2>
    <a href="logout.php">Cerrar Sesión</a>
    <p><?php
        require __DIR__ . '/obtener_nota.php';
        $estudiantes = json_decode(file_get_contents("usuarios.json"), true);
        $informacion = get_user_info($estudiantes, $_SESSION['usuario']);
        foreach ($estudiantes as $key => $value) {
            $nombre = $value["nombre"];
            $apellido = $value["apellido"];
            $nota = $value["nota"];
            echo "Estudiante: $nombre $apellido. Nota de $nota<br>";
        }
        return false;
        ?>
        </p>
</body>

</html>