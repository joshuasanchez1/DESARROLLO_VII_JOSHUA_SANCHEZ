<?php
require_once "config_mysqli.php";

$name = "joshua";
$sql = "DELETE FROM usuarios where nombre = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $name);

    if (mysqli_stmt_execute($stmt)) {
        echo "Valor borrado.";
    } else {
        echo "ERROR: valor no borrado" . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}



mysqli_close($conn);
