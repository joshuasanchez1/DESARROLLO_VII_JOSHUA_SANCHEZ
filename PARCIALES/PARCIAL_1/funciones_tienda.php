<!DOCTYPE html>
<html>

<head>
    <title>

    </title>
</head>

<body>
    <table>
        <tr>
            <th>Articulo comprado</th>
            <th>Precio</th>
            <th>Cantidad comprada</th>
            <th>Sub Total</th>
            <th>Descuento</th>
            <th>Impuesto</th>
            <th>Total</th>
        </tr>

        <?php
        function calcular_descuento($total_compra)
        {
            if ($total_compra < 100) {
                return 0;
            } elseif ($total_compra >= 100 && $total_compra <= 500) {
                return $total_compra * 0.05;
            } elseif ($total_compra >= 501 && $total_compra <= 1000) {
                return $total_compra * 0.10;
            } elseif ($total_compra > 1000) {
                return $total_compra * 0.15;
            }
        }

        function aplicar_impuesto($subtotal)
        {
            return $subtotal * 0.07;
        }

        function calcular_total($subtotal, $descuento, $impuesto)
        {
            return $subtotal - $descuento + $impuesto;
        }
        $precios = ['camisa' => 50, 'pantalon' => 70, 'zapatos' => 80, 'calcetines' => 10, 'gorra' => 25];
        $carrito = [
            'camisa' => 2,
            'pantalon' => 1,
            'zapatos' => 1,
            'calcetines' => 3,
            'gorra' => 0
        ];
        foreach ($carrito as $key => $value) {
            $compra = $value * $precios[$key];
            $descuento = calcular_descuento($compra);
            $impuesto = aplicar_impuesto($compra);
            $total = calcular_total($compra, $descuento, $impuesto);
            echo "<tr>";
            echo "<td>" . $key . "</td>";
            echo "<td>" . $precios[$key] . "</td>";
            echo "<td>" . $carrito[$key] . "</td>";
            echo "<td>" . $compra . "</td>";
            echo "<td>" . $descuento . "</td>";
            echo "<td>" . $impuesto . "</td>";
            echo "<td>" . $total . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>