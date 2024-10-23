<?php
$estudiantes = json_decode(file_get_contents("usuarios.json"), true);
function get_user_info($array, $usuario)
{

    foreach ($array as $key => $value) {
        if ($value["usuario"] == $usuario) {
            return $value;
        }
    }
    return false;
}

// $test = get_user_info($estudiantes,"jaime");
// print_r($test["password"]);