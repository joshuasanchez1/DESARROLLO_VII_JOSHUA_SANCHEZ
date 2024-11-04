
<?php
require_once "config_pdo.php";

$nombre = "joshua";
$email = "joshua@bestprogrammer.com";
$nombre_old = "luis";

// $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
$sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE nombre = :nombre_old";

if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":nombre_old", $nombre_old, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Usuario modificado con éxito.";
    } else {
        echo "ERROR: No se pudo modificar $sql. " . $stmt->errorInfo()[2];
    }
    unset($stmt);
}


unset($pdo);
?>