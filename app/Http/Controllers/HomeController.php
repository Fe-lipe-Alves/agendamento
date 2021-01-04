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
            $calendario[] = [
                'data' => $mes_anterior->copy()->day($i),
                'ocupacao' => rand(0,100),
                'habilitado' => (bool)rand(0,1),
            ];
        }

        for ($i=0; $i<$dias_no_mes; $i++){
            $calendario[] = [
                'data' => $mes_atual->copy()->addDays($i),
                'ocupacao' => rand(0,100),
                'habilitado' => (bool)rand(0,1),
            ];
        }

        for ($i=1; $i<=(6-$ultimo_dia); $i++){
            $calendario[] = [
                'data' => $mes_posterior->copy()->day($i),
                'ocupacao' => rand(0,100),
                'habilitado' => (bool)rand(0,1),
            ];
        }


        return view('pages.home', compact('data', 'calendario'));
    }
}
