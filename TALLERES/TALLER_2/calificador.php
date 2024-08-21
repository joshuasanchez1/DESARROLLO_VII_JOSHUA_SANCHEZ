<!DOCTYPE html>
<html>
<title>
    Calificador PHP
</title>

<body>

    <?php
    $calificacion = 90;

    if ($calificacion >= 90) {
        $calificacion_letra = "A";
    } elseif ($calificacion >= 80 && $calificacion < 90) {
        $calificacion_letra = "B";
    } elseif ($calificacion >= 70 && $calificacion < 80) {
        $calificacion_letra = "C";
    } elseif ($calificacion >= 60 && $calificacion < 70) {
        $calificacion_letra = "D";
    } elseif ($calificacion < 60) {
        $calificacion_letra = "F";
    }
    $mensaje = "El valo de calificacion es: $calificacion <br>";
    echo $mensaje;

    $mensaje_calificacion = "Tu calificacion es: $calificacion_letra <br>";

    $ternario = ($calificacion >= 60) ? "Aprobado":"Reprobado";
    switch ($calificacion_letra){
        case "A":
            echo "Excelente trabajo.<br>";
            break;
        case "B":
            echo "Buen trabajo.<br>";
            break;
        case "C":
            echo "Trabajo aceptable.<br>";
            break;
        case "D":
            echo "Necesitas mejorar.<br>";
            break;
        case "F":
            echo "Deber esforzarte mas.<br>";



    }


    ?>




</body>

</html>