<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Especialista;
use App\Repositories\Contracts\AgendaInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    protected $repository;

    public function __construct(AgendaInterface $agendaRepository)
    {
        $this->repository = $agendaRepository;
    }

    public function index(Request $request)
    {
        $especialista = Especialista::query()->find(1);
        $especialidade = Especialidade::query()->find(1);
        $data = Carbon::now();

        $calendario = $this->repository->obterCalendarioAgenda($especialista, $especialidade, $data);

        return view('pages.home', compact('data', 'calendario'));
    }

    public function informacoesDia(Request $request)
    {

    }
}
