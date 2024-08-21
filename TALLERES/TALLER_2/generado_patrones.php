<!DOCTYPE html>
<html>
<title>
    Generador patrones
</title>

<body>

    <?php
    echo "Triangulo<br>";
    for ($i = 1; $i <= 5; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "*";
        }
        echo "<br>";
    }
    echo "<br>";

    echo "Numeros impares del 1 al 20.<br>";

    $contador = 1;
    while ($contador  <= 20) {
        if ($contador % 2 != 0) {
            echo "Numero impar: $contador <br>";
        }
        $contador++;
    }

    echo "<br>";

    echo "Contador do-while<br>";

    $otro_contador = 10;

    do {
        if ($otro_contador != 5) {
            echo "Numero diferente a 5: $otro_contador<br>";
        }
        $otro_contador--;
    } while ($otro_contador >= 1);

    ?>




</body>

</html>