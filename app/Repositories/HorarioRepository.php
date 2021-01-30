<?php


namespace App\Repositories;


use App\Models\DiaSemana;
use App\Models\Evento;
use App\Models\Horario;
use App\Repositories\Contracts\ConsultaInterface;
use App\Repositories\Contracts\DiaSemanaInterface;
use App\Repositories\Contracts\EventoInterface;
use App\Repositories\Contracts\HorarioInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HorarioRepository extends BaseRepository implements HorarioInterface
{
    protected $modelClass = Horario::class;

    public function obterPorDataAgenda($diaSemana, Model $agenda)
    {
        if (!$diaSemana instanceof DiaSemana){
            try {
                /** @var  $dia_semana_repository DiaSemanaInterface */
                $dia_semana_repository = app(DiaSemanaInterface::class);
                $diaSemana = $dia_semana_repository->resolverDia($diaSemana);

                if ($diaSemana == null)
                    throw new \Exception();
            } catch (\Exception $e) {
                throw new \Exception("Dia da semana não identificado");
            }
        }

        return Horario::query()
            ->join('dias_semana', 'horarios.dia_semana_id', '=', 'dias_semana.id')
            ->where('dias_semana.id', $diaSemana->id)
            ->where('agenda_id', $agenda->id)->first();
    }

    public function tempoHabil(Carbon $data, Model $agenda)
    {
        try {
            $dia_semana = (app(DiaSemanaInterface::class))->resolverDia($data);

            $horario = $this->obterPorDataAgenda($dia_semana, $agenda);

            if (!$horario)
                return 0;

            $abertura = new Carbon($horario->abertura);
            $inicio_intervalo = new Carbon($horario->inicio_intervalo);
            $termino_intervalo = new Carbon($horario->termino_intervalo);
            $encerranto = new Carbon($horario->encerranto);

            $duracao = ($encerranto->diffInMinutes($abertura)) - ($termino_intervalo->diffInMinutes($inicio_intervalo));

            $eventos = (app(EventoInterface::class))->retornaExistente($data, $agenda);
            if ($eventos) {
                $horario_ocupado = 0;
                foreach ($eventos as $evento ) {
                    $inicio_evento = new Carbon($evento->inicio);
                    $termino_evento = new Carbon($evento->termino);
                    if (!$evento->habilitado)
                        $horario_ocupado += ($termino_evento->diffInMinutes($inicio_evento));
                }
                return $duracao - $horario_ocupado;
            }

            return $duracao;
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function proximoHorario($data, Model $agenda)
    {
        try {
            $this->tempoAtividade($data, $agenda);

            $eventos = (app(EventoInterface::class))->retornaExistente($data, $agenda);
            $dia_semana = (app(DiaSemanaInterface::class))->resolverDia($data);
            $horario = $this->obterPorDataAgenda($dia_semana, $agenda);

            if (!$horario)
                return null;

            $abertura = new Carbon($horario->abertura);
            $inicio_intervalo = new Carbon($horario->inicio_intervalo);
            $termino_intervalo = new Carbon($horario->termino_intervalo);
            $encerranto = new Carbon($horario->encerramento);

            $evento = Arr::first($eventos);
            if ($evento){
                $inicio = new Carbon($evento->inicio);
                $termino = new Carbon($evento->termino);

                if ($inicio->toTimeString() == $abertura->toTimeString() &&
                    $termino->toTimeString() == $encerranto->toTimeString()
                ) {
                    return "indisponivel";
                }

                if($inicio->equalTo($abertura)){
                    $inicio_atividade = $termino;
                }
            }

//            return $horario;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function tempoAtividade($data, Model $agenda){
        /**
         * @var EventoInterface $evento_repository
         */
        $evento_repository = app(EventoInterface::class);
        $eventos = $evento_repository->retornaExistente($data, $agenda);
        $dia_semana = (app(DiaSemanaInterface::class))->resolverDia($data);
        $horario = $this->obterPorDataAgenda($dia_semana, $agenda);
        $intervalos = new Collection();

        if (!$horario)
            return $intervalos;

        $abertura = new Carbon($horario->abertura);
        $inicio_intervalo = new Carbon($horario->inicio_intervalo);
        $termino_intervalo = new Carbon($horario->termino_intervalo);
        $encerranto = new Carbon($horario->encerramento);

        $inicio_almoco = $inicio_intervalo;
        $termino_almoco = $termino_intervalo;

            if ($eventos->count() > 0){

            $inicio_atividade = $abertura;

            foreach ($eventos as $evento){
                if($evento->inicio->format('H:i') != $inicio_atividade->format('H:i')) {
                    $intervalos->add([
                        'inicio' => $inicio_atividade,
                        'termino' => $evento->inicio
                    ]);
                }

                if ($evento->habilitado == true){
                    $intervalos->add([
                        'inicio' => $evento->inicio,
                        'termino' => $evento->termino
                    ]);
                }

                // Verifica se o evento começa durante o intervalo e termina depois do intervalo
                //      |  [--|--]     //
                if (strtotime($evento->termino->format('H:i')) > strtotime($termino_intervalo->format('H:i'))
                    && strtotime($evento->inicio->format('H:i')) < strtotime($termino_intervalo->format('H:i'))
                    && strtotime($evento->inicio->format('H:i')) > strtotime($inicio_intervalo->format('H:i'))
                ){
                    $termino_almoco = $evento->inicio;
                }

                // Verifica se o evento começa antes do intervalo e termina durante o intervalo
                //      [--|--]    |     //
                if (strtotime($evento->inicio->format('H:i')) < strtotime($inicio_intervalo->format('H:i'))
                    && strtotime($evento->termino->format('H:i')) < strtotime($termino_intervalo->format('H:i'))
                    && strtotime($evento->termino->format('H:i')) > strtotime($inicio_intervalo->format('H:i'))
                ){
                    $inicio_almoco = $evento->termino;
                }

                $inicio_atividade = $evento->termino;
            }

                // Verifica se o tem algum horaroi disponivel no dia
                // [                       ] //
            if($inicio_atividade->format('H:i') == $encerranto->format('H:i')){
                return $intervalos;
            }

            $intervalos->add([
                'inicio' => $inicio_atividade,
                'termino' => $encerranto
            ]);

        }

        $eventos->add(new Evento([
            'inicio' => $inicio_almoco,
            'termino' => $termino_almoco,
            'habilitado' => false
        ]));

        if($data->format('d-m-y') == Carbon::yesterday()->subDay()->format('d-m-y'))
            dd($intervalos, $abertura, $eventos);
    }
}
