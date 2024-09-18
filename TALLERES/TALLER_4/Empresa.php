<?php
require_once 'Gerente.php';
class Empresa extends Gerente
{
    public $nombre;
    public $id;
    public $salario;
    public $bono;
    public function __construct($nombre, $id, $salario, $bono)
    {
        parent::__construct($bono,"Joshua Sanchez","Contabilidad","John",1,123);
        $this->nombre = $nombre;
        $this->id = $id;
        $this->salario = $salario;
        $this->bono = $bono;
    }
    public function agregar_empleado($file,$nombre, $id, $salario, $bono, $array_inicial)
    {
        $nuevo_empleado = [
            "nombre" => $nombre,
            "id" => $id,
            "salario" => $salario,
            "bono" => $bono

        ];

        $array_inicial[] = $nuevo_empleado;
        print_r($nuevo_empleado);
        print_r($array_inicial);
        file_put_contents($file, json_encode($array_inicial, JSON_PRETTY_PRINT));
        return $array_inicial;
    }
}
