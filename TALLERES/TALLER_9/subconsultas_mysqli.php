<?php
require_once "config_mysqli.php";

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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        $precio = $row['precio'];
        $promedio = $row['promedio_categoria'];
        echo "Producto: {$row['nombre']}, Precio: $$precio, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: $$promedio<br>";
    }
    mysqli_free_result($result);
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

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        $total_compras = $row['total_compras'];
        $promedio_ventas = $row['promedio_ventas'];
        echo "Cliente: {$row['nombre']}, Total compras: $$total_compras, ";
        echo "Promedio general: $$promedio_ventas<br>";
    }
    mysqli_free_result($result);
}
// 3. Encontrar los productos que nunca se han vendido
$sql = "SELECT p.nombre,p.descripcion, COUNT(dv.id) AS cantidad_vendida
FROM productos p
LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
GROUP BY p.nombre,p.descripcion
HAVING COUNT(dv.id) < 1;";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos que nunca se an vendido:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $cantidad_vendida = $row['cantidad_vendida'];
        echo "Nombre producto: $nombre, Descripcion: $descripcion, ";
        echo "Cantidad Comprada: $$cantidad_vendida<br>";
    }
    mysqli_free_result($result);
}
// 4. Listar las categorías con el número de productos y el valor total del inventario.
$sql = "SELECT c.id AS categoria_id, c.nombre AS categoria_nombre, c.descripcion AS categoria_descripcion, SUM(p1.stock) AS total_stock, SUM(p1.total_inventario) AS total_inventario
FROM categorias c
JOIN (
SELECT c.id AS categoria_id,p.nombre AS nombre_producto, p.descripcion AS descripcion_producto, p.precio,p.stock, c.nombre AS categoria_nombre,c.descripcion AS categoria_descripcion, p.precio*p.stock AS total_inventario
FROM productos p, categorias c
WHERE p.categoria_id = c.id) AS p1 ON c.id = p1.categoria_id
WHERE c.id = p1.categoria_id
GROUP BY c.id, c.nombre, c.descripcion;

";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos que nunca se an vendido:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        $categoria_nombre = $row['categoria_nombre'];
        $categoria_descripcion = $row['categoria_descripcion'];
        $total_inventario = $row['total_inventario'];
        $total_stock = $row['total_stock'];
        echo "Nombre de Categoria: $categoria_nombre" . ", Descripcion de la categoria: $categoria_descripcion" . "<br>";
        echo "Cantidad Stock: $total_stock<br>";
        echo "Total Inventario: $$total_inventario<br>";
    }
    mysqli_free_result($result);
}

mysqli_close($conn);
