<!DOCTYPE html>
<html>

<head>
    <title>
        Parcial 1
    </title>
</head>

<body>
    <table>
        <tr>
            <th>Frase original</th>
            <th>Cantidad palabras</th>
            <th>Cantidad vocales</th>
            <th>invertida</th>
        </tr>
        <tr>

            <?php

            use function PHPSTORM_META\type;

            require __DIR__ . '/utilidades_texto.php';
            $frases = ["The quick brown fox jumps over the lazy dog", "El pollo frito casero crea muchos trastes para fregar", "Las galletas caseras son deliciosas"];
            for ($i = 0; $i < count($frases); $i++) {
                $frase = $frases[$i];
                $cantidad_palabras = contar_palabras($frase);
                $cantidad_vocales = contar_vocales($frase);
                $invertida = invertir_palabras($frase);
                echo "<tr>";
                echo "<td>" . $frase . "</td>";
                echo "<td>" . $cantidad_palabras . "</td>";
                echo "<td>" . $cantidad_vocales . "</td>";
                echo "<td>" . $invertida . "</td>";
                echo "</tr>";
            }
            ?>
        </tr>
    </table>
</body>

</html>