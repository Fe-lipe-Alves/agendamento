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

        $agenda = $this->repository->obterAgenda($especialista, $especialidade);
        $calendario = $this->repository->obterCalendarioAgenda($especialista, $especialidade, $data);

        return view('pages.home', compact('data', 'calendario', 'agenda'));
    }

    public function informacoesDia(Request $request)
    {
        $data = $request->data ?? null;
        $agenda = $request->agenda ?? null;

        $resposta = $this->repository->informacoesData($data, $agenda);
        $consultas = $resposta['consultas'];
        $data = new Carbon($data);
        return view('components.agenda.detalhes', compact('consultas', 'data'));
    }
}
