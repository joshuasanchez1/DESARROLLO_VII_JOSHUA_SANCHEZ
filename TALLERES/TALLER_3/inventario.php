<!DOCTYPE html>
<html>

<head>
    <title>Ejercicio practico Taller#3</title>
</head>

<body>
    <h2>
        Testing
    </h2>

    <?php
    function leer_archivo($ruta_archivo)
    {
        $resultados = json_decode(file_get_contents($ruta_archivo), true);
        return $resultados;
    }
    function ordenar_alfabeticamente($val_array)
    {
        sort($val_array);
        return $val_array;
    }
    function chequiar_stock_bajo($nombre, $cantidad, $precio)
    {
        if ($cantidad < 5) {
            printf("El siguiente producto tiene stock bajo: %s. Hay una cantidad restante de: %d<br>", $nombre, $cantidad);
            printf("El producto %s lo vendemos en: $%.2f", $nombre, $precio);
        } else {
            printf("El producto %s tiene buen stock con una cantidad en stock de: %d", $nombre, $cantidad);
        }
        echo "<br>";
        echo "<br>";
    }
    function resumen_producto($nombre, $precio, $cantidad)
    {
        printf("Nombre producto: %s, tiene un precio de $%.2f. Tenemos una cantidad de %d", $nombre, $precio, $cantidad);
    }
    function calcular_total($array)
    {
        $len_array = count($array);
        $acumulador = 0;
        for ($i = 0; $i < $len_array; $i++) {
            $current_element = $array[$i];
            $precio_total = $current_element["precio"] * $current_element["cantidad"];
            $acumulador += $precio_total;
        }
        return $acumulador;
    }
    $contenido_inventario = leer_archivo("inventario.json");
    print_r($contenido_inventario);
    echo "<br>";
    echo "<br>";
    $ordenado = ordenar_alfabeticamente($contenido_inventario);
    echo "Contenido de inventario alfabeticamente:";
    echo "<br>";
    $precio_total = 0;
    for ($i = 0; $i < count($ordenado); $i++) {
        $current_element = $ordenado[$i];
        resumen_producto($current_element["nombre"], $current_element["precio"], $current_element["cantidad"]);
        echo "<br>";
        echo "<br>";
        chequiar_stock_bajo($current_element["nombre"], $current_element["cantidad"], $current_element["precio"]);
    }
    echo "<br>";
    echo "<br>";
    printf("Precio total del inventario: $%.2f", calcular_total($contenido_inventario));
    ?>
</body>

</html>