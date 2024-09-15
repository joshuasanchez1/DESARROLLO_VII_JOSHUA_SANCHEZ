<?php
require_once 'Empleado.php';

class Gerente extends Empleado
{
    public $bono;
    public $gerente_nombre;
    public $departamento;

    public function __construct($bono, $gerente_nombre, $departamento, $emp_nombre, $emp_id, $emp_salario)
    {
        parent::__construct($emp_nombre, $emp_id, $emp_salario);
        $this->bono = $bono;
        $this->gerente_nombre = $gerente_nombre;
        $this->departamento = $departamento;
    }
    public function get_all_emp_info($file)
    {
        $file = file_get_contents($file);
        return json_decode($file, true);
    }
    public function get_emp_info($id)
    {
        $empleados = $this->get_all_emp_info('empleados.json');
        for ($i = 0; $i < count($empleados); $i++) {
            if ($empleados[$i]["id"] == $id) {
                parent::set_id($i);
                return $empleados[$i];
            }
        }
        return false;
    }
    public function cambiarBono($array, $nuevoBono)
    {
        $array["bono"] = $nuevoBono;
        $id = parent::get_id();
        $empleados = $this->get_all_emp_info('empleados.json');
        $empleados[$id] = $array;
        file_put_contents('empleados.json', json_encode($empleados, JSON_PRETTY_PRINT));
        return $array;
    }
}
// $gerente = new Gerente(123, "Jose Ramirez", "Contabilidad", "Juan Perez", 1, 321);
// $id = 1;
// $current_emp = $gerente->get_emp_info($id);
// if (!$current_emp) {
//     echo "No se encontro ese empleado";
// } else {
//     print_r($current_emp);
// }
// print_r($gerente->cambiarBono($current_emp, 123));
