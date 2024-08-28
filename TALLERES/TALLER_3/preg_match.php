
<?php
// Ejemplo básico de preg_match()
$texto = "El código postal es 12345";
$patron = "/\d{5}/"; // Busca 5 dígitos consecutivos
if (preg_match($patron, $texto, $coincidencias)) {
    echo "Código postal encontrado: {$coincidencias[0]}
";
} else {
    echo "No se encontró un código postal válido.
";
}

// Ejemplo de validación de email
function validarEmail($email) {
    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($patron, $email);
}

$email1 = "usuario@example.com";
$email2 = "usuario@.com";
echo "¿'{$email1}' es un email válido? " . (validarEmail($email1) ? "Sí" : "No") . "
";
echo "¿'{$email2}' es un email válido? " . (validarEmail($email2) ? "Sí" : "No") . "
";

// Ejercicio: Extraer el nombre de usuario de una dirección de Twitter
function extraerUsuarioTwitter($tweet) {
    $patron = "/@([a-zA-Z0-9_]+)/";
    if (preg_match($patron, $tweet, $coincidencias)) {
        return $coincidencias[1];
    }
    return null;
}

$tweet = "Sígueme en @usuario_ejemplo para más contenido!";
$usuario = extraerUsuarioTwitter($tweet);
echo "
Usuario de Twitter extraído: " . ($usuario ? "@$usuario" : "No se encontró usuario") . "
";

// Bonus: Extraer información de una cadena con formato específico
$info = "Nombre: Juan, Edad: 30, Ciudad: Madrid";
$patron = "/Nombre: ([^,]+), Edad: (\d+), Ciudad: ([^,]+)/";
if (preg_match($patron, $info, $coincidencias)) {
    echo "
Información extraída:
";
    echo "Nombre: {$coincidencias[1]}
";
    echo "Edad: {$coincidencias[2]}
";
    echo "Ciudad: {$coincidencias[3]}
";
}

// Extra: Validar formato de número de teléfono
function validarTelefono($telefono) {
    $patron = "/^(\+\d{1,3}[- ]?)?\d{9,10}$/";
    return preg_match($patron, $telefono);
}

$telefono1 = "+34 123456789";
$telefono2 = "123-456-7890";
echo "
¿'{$telefono1}' es un teléfono válido? " . (validarTelefono($telefono1) ? "Sí" : "No") . "
";
echo "¿'{$telefono2}' es un teléfono válido? " . (validarTelefono($telefono2) ? "Sí" : "No") . "
";

// Desafío: Extraer todas las etiquetas HTML de un string
function extraerEtiquetasHTML($html) {
    $patron = "/<(\w+)\s*[^>]*>/";
    preg_match_all($patron, $html, $coincidencias);
    return $coincidencias[1];
}

$html = "Este es un enlace en un párrafo.";
$etiquetas = extraerEtiquetasHTML($html);
echo "
Etiquetas HTML encontradas: " . implode(", ", $etiquetas) . "
";
?>
      
