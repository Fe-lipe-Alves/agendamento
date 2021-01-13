<?php


namespace App\Repositories;


use App\Models\Horario;
use App\Repositories\Contracts\DiaSemanaInterface;
use App\Repositories\Contracts\EventoInterface;
use App\Repositories\Contracts\HorarioInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HorarioRepository extends BaseRepository implements HorarioInterface
{
    protected $modelClass = Horario::class;

    public function obterPorDataAgenda(Model $diaSemana, Model $agenda)
    {
        return Horario::query()
            ->join('dias_semana', 'horarios.dia_semana_id', '=', 'dias_semana.id')
            ->where('dias_semana.id', $diaSemana->id)
            ->where('agenda_id', $agenda->id)->first();
    }

    public function tempoHabil(Carbon $data, Model $agenda)
    {
        if ($data->format('d/m/Y') == '12/01/2021')
            $teste = 12;

        $dia_semana = (app(DiaSemanaInterface::class))->resolverDia($data);


        DB::enableQueryLog();
        $horario = $this->obterPorDataAgenda($dia_semana, $agenda);

//        $x = DB::getQueryLog();
//        if ($data->format('d/m/Y') == '12/01/2021')
//            dd($x);

        if (!$horario)
            return 0;

        $abertura = new Carbon($horario->abertura);
        $inicio_intervalo = new Carbon($horario->inicio_intervalo);
        $termino_intervalo = new Carbon($horario->termino_intervalo);
        $encerranto = new Carbon($horario->encerranto);

        $duracao = ($encerranto->diffInMinutes($abertura)) - ($termino_intervalo->diffInMinutes($inicio_intervalo));

        $evento = (app(EventoInterface::class))->retornaExistente($data, $this->model());
        if ($evento){
            $inicio_evento = new Carbon($evento->inicio);
            $termino_evento = new Carbon($evento->termino);

            if ($abertura->equalTo($inicio_evento) && $encerranto->equalTo($termino_evento))
                return 0;

            if (!$evento->habilitado)
                return $duracao - ($termino_evento->diffInMinutes($inicio_evento));
        }

        return $duracao;
    }
}
