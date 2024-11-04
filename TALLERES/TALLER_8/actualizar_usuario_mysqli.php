<?php
require_once "config_mysqli.php";

$name = "emperor";
$email = "bestimperium@godemperor.com";
$nombre_old = "angron";
$sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE nombre = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $nombre_old);

    if (mysqli_stmt_execute($stmt)) {
        echo "Modificacion exitosa.";
    } else {
        echo "ERROR: modificacion sin exito" . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}



mysqli_close($conn);
