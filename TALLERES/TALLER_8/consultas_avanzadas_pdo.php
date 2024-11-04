<?php
require_once "config_pdo.php";

try {
    // 1. Mostrar todos los usuarios junto con el número de publicaciones que han hecho
    $sql = "SELECT u.id, u.nombre, COUNT(p.id) as num_publicaciones 
            FROM usuarios u 
            LEFT JOIN publicaciones p ON u.id = p.usuario_id 
            GROUP BY u.id";

    $stmt = $pdo->query($sql);

    echo "<h3>Usuarios y número de publicaciones:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Usuario: " . $row['nombre'] . ", Publicaciones: " . $row['num_publicaciones'] . "<br>";
    }

    // 2. Listar todas las publicaciones con el nombre del autor
    $sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
            FROM publicaciones p 
            INNER JOIN usuarios u ON p.usuario_id = u.id 
            ORDER BY p.fecha_publicacion DESC";

    $stmt = $pdo->query($sql);

    echo "<h3>Publicaciones con nombre del autor:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }


    // 3. Encontrar el usuario con más publicaciones
    $sql = "SELECT u.nombre, COUNT(p.id) as num_publicaciones 
            FROM usuarios u 
            LEFT JOIN publicaciones p ON u.id = p.usuario_id 
            GROUP BY u.id 
            ORDER BY num_publicaciones DESC 
            LIMIT 1";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h3>Usuario con más publicaciones:</h3>";
    echo "Nombre: " . $row['nombre'] . ", Número de publicaciones: " . $row['num_publicaciones'];

    // 4. Mostrar las últimas 5 publicaciones con el nombre del autor y la fecha de publicación
    $sql = "SELECT p.id, p.titulo , p.contenido, u.nombre AS autor, p.fecha_publicacion
            FROM publicaciones p, usuarios u
            WHERE u.id = p.id
            ORDER BY p.id DESC
            LIMIT 5";

    $stmt = $pdo->query($sql);

    echo "<h3>Ultimas 5 publicaciones con nombre de autor y fecha de publicacion:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Titulo del libro: " . $row['titulo'] . ", Contenido del libro: " . $row['contenido'] . ", Autor del libro: " . $row['autor'] . ", Fecha de publicacion: " . $row["fecha_publicacion"] . "<br>";
    }
    // 5. Listar los usuarios que no han realizado ninguna publicación
    $sql = "SELECT u.id, u.nombre, COUNT(p.usuario_id) AS cantidad_publicaciones
FROM usuarios u
LEFT JOIN publicaciones p ON u.id = p.usuario_id
GROUP BY u.id, u.nombre
having COUNT(p.usuario_id) <1;";

    $stmt = $pdo->query($sql);

    echo "<h3>Usuarios sin publicaciones:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Nombre de usuario: " . $row['nombre'] . ", Cantidad de publicaciones: " . $row['cantidad_publicaciones'] . "<br>";
    }
    // 6. Ultima publicacion por usuario
$sql = "SELECT u.nombre, lp.titulo,lp.contenido, lp.fecha_publicacion
FROM usuarios u, (
SELECT p.usuario_id, p.fecha_publicacion, p.contenido,p.titulo
FROM publicaciones p
WHERE p.id = (
SELECT MAX(id)
FROM publicaciones
WHERE usuario_id = p.usuario_id
)) AS lp
WHERE u.id = lp.usuario_id;
";

    $stmt = $pdo->query($sql);

    echo "<h3>Ultima publicacion por usuario:</h3>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Nombre de usuario: " . $row['nombre'] . ", Titulo: " . $row['titulo'] . ", Contenido: " . $row['contenido'] . ", Fecha de publicacion: " . $row["fecha_publicacion"] . "<br>";

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
