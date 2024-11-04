
<?php
require_once "config_pdo.php";

$nombre = "emperor";

$sql = "DELETE FROM usuarios WHERE nombre = :nombre";

if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Usuario borrado con éxito.";
    } else {
        echo "ERROR: No se pudo borrar $sql. " . $stmt->errorInfo()[2];
    }
    unset($stmt);
}


unset($pdo);
?>