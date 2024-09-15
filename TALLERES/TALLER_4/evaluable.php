<?php

function evaluarDesempenio($bono)
{
    if ($bono >= 1000) {
        return "Sobresaliente";
    } elseif ($bono >= 500) {
        return "Bueno";
    } elseif ($bono >= 250) {
        return "Regular";
    } elseif ($bono < 250) {
        return "Deficiente";
    }
}
