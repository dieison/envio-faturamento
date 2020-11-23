<?php

namespace App\Http\Controllers;

use App\EnvioFaturamento;

class RegistroDeVisualuzacao extends Controller
{
    public function setRegistroDeVisualizacao($cdrcd)
    {
        return EnvioFaturamento::atualizarStatusVisualizacao($cdrcd);
    }
}
