<!DOCTYPE html>
<html>
<title>
    Primer PHP
</title>
<body>

    <?php
$nombre = "Joshua";
$edad = 29;

// Usando echo
echo "Hola, mundo!<br>";
echo "Mi nombre es $nombre<br>";

// Usando print
print "Tengo $edad años<br>";

// Usando printf (permite formateo)
printf("Me llamo %s y tengo %d años<br>", $nombre, $edad);

// Usando var_dump (útil para debugging)
var_dump($nombre);
?>
</body>
</html>
                        
