<?php

require __DIR__ . '/Empresa.php';
require __DIR__ . '/evaluable.php';


function listar_empleados($array)
{
    print_r($array);
    
    for ($i = 0; $i < count($array); $i++) {
        $current_item = $array[$i];
        $nombre = $current_item["nombre"];
        $id = $current_item["id"];
        $salario = $current_item["salario"];
        $bono = $current_item["bono"];
        $desempenio = evaluarDesempenio($bono);
        printf("Empleado: %s", $nombre);
        echo "<br>";
        printf("ID: %d", $id);
        echo "<br>";
        printf("Salario: %d", $salario);
        echo "<br>";
        printf("Bono: %d", $bono);
        echo "<br>";
        printf("Desempeño: %s", $desempenio);
        echo "<br>";
        printf("Nomina total: %d", $salario + $bono);
        echo "<br>";
        echo "<br>";
    }
}
echo "Toda la informacion de los empleados actuales: <br>";
$empresa = new Empresa("Joshua", 13, 12345, 321);
$file = 'empleados.json';
$empleados = $empresa->get_all_emp_info($file);
listar_empleados($empleados);

echo "<br>";
echo "Agregar nuevo empleado: ";
echo "<br>";
$nombre = "John Cena";
$id = 6;
$salario = 12345;
$bono = 456;
echo "Nombre: $nombre";
echo "<br>";
echo "Id: $id";
echo "<br>";
echo "Salario: $salario";
echo "<br>";
echo "Bono: $bono";
echo "<br>";
$nuevo = $empresa->agregar_empleado('empleados.json', $nombre, $id, $salario, $bono, $empleados);
echo "Listar informacion completa denuevo: <br>";
listar_empleados($nuevo);

