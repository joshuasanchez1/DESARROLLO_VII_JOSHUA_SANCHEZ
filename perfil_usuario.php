<!DOCTYPE html>
<html>
<title>
    Primer PHP
</title>
<body>

    <?php
// Definición de variables
$nombre_completo = "Joshua Sanchez";
$edad = 29;
$correo = "joshua.sanchez@utp.ac.pa";
$telefono = "123456789";

define("OCUPACION","Estudiante");

// Creación de mensaje usando diferentes métodos de concatenación e impresión
$mensaje1 = "Hola, mi nombre es " . $nombre_completo . " y tengo " . $edad . " años.";
$mensaje2 = "Tengo $edad y soy " . OCUPACION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

// printf("Las novelas web son muy diversas: %s, %d años, %s, %s<br>", $nombre, $edad, $ciudad, OCUPACION);

echo "<br>Información de debugging:<br>";
var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump(OCUPACION);
echo "<br>";
?>
</body>
</html>
                        
