<?php
function contar_palabras($texto)
{
    $texto = str_word_count($texto);
    return $texto;
}

function contar_vocales($texto)
{
    $texto = strtolower($texto);
    $vocales = ["a", "e", "i", "o", "u"];
    $contador = 0;
    for ($i = 0; $i < strlen($texto); $i++) {
        if (in_array($texto[$i], $vocales)) {
            $contador++;
        }
    }
    return $contador;
}

function invertir_palabras($texto)
{
    $array = explode(" ",$texto);
    $array = array_reverse($array);
    $texto = implode(" ",$array);
    return $texto;
}
