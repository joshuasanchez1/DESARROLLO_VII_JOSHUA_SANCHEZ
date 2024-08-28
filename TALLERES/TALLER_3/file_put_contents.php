
<?php
// Ejemplo básico de file_put_contents()
$archivo = "ejemplo.txt";
$contenido = "Este es un ejemplo de contenido para el archivo.
";

if (file_put_contents($archivo, $contenido) !== false) {
    echo "Archivo creado exitosamente.
";
} else {
    echo "Hubo un error al crear el archivo.
";
}

// Leer el contenido del archivo para verificar
echo "Contenido del archivo:
" . file_get_contents($archivo);

// Ejemplo de añadir contenido al final del archivo
$nuevoContenido = "Esta es una nueva línea añadida al archivo.
";
if (file_put_contents($archivo, $nuevoContenido, FILE_APPEND) !== false) {
    echo "
Contenido añadido exitosamente.
";
} else {
    echo "
Hubo un error al añadir contenido.
";
}

echo "Contenido actualizado del archivo:
" . file_get_contents($archivo);

// Ejercicio: Crear un archivo de registro (log)
function agregarLog($mensaje) {
    $archivoLog = "registro.log";
    $timestamp = date("Y-m-d H:i:s");
    $entradaLog = "[$timestamp] $mensaje
";
    return file_put_contents($archivoLog, $entradaLog, FILE_APPEND);
}

agregarLog("Inicio de la aplicación");
agregarLog("Usuario 'admin' ha iniciado sesión");
agregarLog("Se ha realizado una acción importante");

echo "
Contenido del archivo de registro:
" . file_get_contents("registro.log");

// Bonus: Escribir un array en un archivo CSV
$datos = [
    ['Nombre', 'Edad', 'Ciudad'],
    ['Juan', 25, 'Madrid'],
    ['María', 30, 'Barcelona'],
    ['Carlos', 22, 'Valencia']
];

$archivoCSV = "datos.csv";
$contenidoCSV = "";

foreach ($datos as $fila) {
    $contenidoCSV .= implode(",", $fila) . "
";
}

if (file_put_contents($archivoCSV, $contenidoCSV) !== false) {
    echo "
Archivo CSV creado exitosamente.
";
} else {
    echo "
Hubo un error al crear el archivo CSV.
";
}

echo "Contenido del archivo CSV:
" . file_get_contents($archivoCSV);

// Extra: Usar LOCK_EX para escritura segura en entornos multiusuario
$archivoSeguro = "archivo_seguro.txt";
$datosImportantes = "Estos son datos importantes que requieren escritura segura.
";

if (file_put_contents($archivoSeguro, $datosImportantes, LOCK_EX) !== false) {
    echo "
Datos escritos de forma segura.
";
} else {
    echo "
Hubo un error al escribir los datos de forma segura.
";
}

// Desafío: Crear una función para guardar y cargar datos serializados
function guardarDatos($archivo, $datos) {
    return file_put_contents($archivo, serialize($datos));
}

function cargarDatos($archivo) {
    $contenido = file_get_contents($archivo);
    return $contenido !== false ? unserialize($contenido) : false;
}

$datosUsuario = [
    'nombre' => 'Ana',
    'edad' => 28,
    'intereses' => ['lectura', 'viajes', 'fotografía']
];

guardarDatos("datos_usuario.dat", $datosUsuario);
$datosRecuperados = cargarDatos("datos_usuario.dat");

echo "
Datos recuperados:
";
print_r($datosRecuperados);
?>
      
