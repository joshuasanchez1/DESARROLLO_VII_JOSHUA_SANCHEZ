
<?php
require_once "config_pdo.php";

try {
    // 1. Productos que tienen un precio mayor al promedio de su categoría
    $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
            (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE p.precio > (
                SELECT AVG(precio)
                FROM productos p2
                WHERE p2.categoria_id = p.categoria_id
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $precio = $row['precio'];
        $promedio = $row['promedio_categoria'];
        echo "Producto: {$row['nombre']}, Precio: $$precio, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: $$promedio<br>";
    }

    // 2. Clientes con compras superiores al promedio
    $sql = "SELECT c.nombre, c.email,
            (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
            (SELECT AVG(total) FROM ventas) as promedio_ventas
            FROM clientes c
            WHERE (
                SELECT SUM(total)
                FROM ventas
                WHERE cliente_id = c.id
            ) > (
                SELECT AVG(total)
                FROM ventas
            )";

    $stmt = $pdo->query($sql);
    
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $total_compras = $row['total_compras'];
        $promedio_ventas = $row['promedio_ventas'];
        echo "Cliente: {$row['nombre']}, Total compras: $$total_compras, ";
        echo "Promedio general: $$promedio_ventas<br>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>