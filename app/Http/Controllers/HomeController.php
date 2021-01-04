<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Carbon::now();
        $mes_atual = $data->copy()->firstOfMonth();
        $mes_anterior = $data->copy()->subMonth();
        $mes_posterior = $data->copy()->addMonth();
        $dias_no_mes = $data->daysInMonth;
        $primeiro_dia = $data->copy()->firstOfMonth()->dayOfWeek;
        $ultimo_dia = $data->copy()->lastOfMonth()->dayOfWeek;
        $comeco_semana = $mes_anterior->copy()->daysInMonth - $primeiro_dia + 1;
        $calendario = array();

        for ($i=$comeco_semana; $i<=$mes_anterior->copy()->daysInMonth; $i++){
            $calendario[] = $mes_anterior->copy()->day($i);
        }

        for ($i=0; $i<$dias_no_mes; $i++){
            $calendario[] = $mes_atual->copy()->addDays($i);
        }

        for ($i=1; $i<=(6-$ultimo_dia); $i++){
            $calendario[] = $mes_posterior->copy()->day($i);
        }


        return view('pages.home', compact('data', 'calendario'));
    }
}
