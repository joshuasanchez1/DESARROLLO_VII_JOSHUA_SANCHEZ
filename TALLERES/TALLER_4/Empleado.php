<?php
class Empleado
{
    public $nombre;
    public $id;
    public $salario;
    public function __construct($nombre, $id, $salario)
    {
        $this->set_nombre($nombre);
        $this->set_id($id);
        $this->set_salario($salario);
    }
    public function set_nombre($nombre)
    {
        $this->nombre = trim($nombre);
    }
    public function set_id($id)
    {
        $this->id = trim($id);
    }
    public function set_salario($salario)
    {
        $this->salario = trim($salario);
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_salario()
    {
        return $this->salario;
    }
}
