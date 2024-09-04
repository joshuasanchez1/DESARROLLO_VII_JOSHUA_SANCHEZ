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
    echo "Subtotal: $" . $compra . "<br>";
    printf("Descuento aplicado: $%.2f<br>", $descuento);
    printf("Impuesto: $%.2f<br>", $impuesto);
    printf("Total a pagar: $%.2f<br>", $total);
    echo "<br>";
}
