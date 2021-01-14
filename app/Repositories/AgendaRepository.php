<?php


namespace App\Repositories;


use App\Models\Agenda;
use App\Repositories\Contracts\AgendaInterface;
use App\Repositories\Contracts\ConsultaInterface;
use App\Repositories\Contracts\HorarioInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AgendaRepository extends BaseRepository implements AgendaInterface
{
    protected $modelClass = Agenda::class;

    public function salvar()
    {
        // TODO: Implement salvar() method.
    }

    public function obterCalendarioAgenda(Model $especialista, Model $especialidade, Carbon $data)
    {
        $agenda = $this->obterAgenda($especialista, $especialidade);
        if($agenda == null)
            throw new \Exception("Agenda não identificada");

        return $this->gerarCalendario($data);
    }

    public function obterAgenda(Model $especialista, Model $especialidade)
    {
        $agenda = Agenda::query()->where('especialista_id', $especialista->id)
            ->where('especialidade_id', $especialidade->id)->first();

        $this->model($agenda);
        return $agenda;
    }

    public function gerarCalendario(Carbon $data)
    {
        $mes_atual = $data->copy()->firstOfMonth();
        $mes_anterior = $data->copy()->subMonth();
        $mes_posterior = $data->copy()->addMonth();
        $dias_no_mes = $data->daysInMonth;
        $primeiro_dia = $data->copy()->firstOfMonth()->dayOfWeek;
        $ultimo_dia = $data->copy()->lastOfMonth()->dayOfWeek;
        $comeco_semana = $mes_anterior->copy()->daysInMonth - $primeiro_dia + 1;
        $dias = array();
        $calendario = array();

        for ($i=$comeco_semana; $i<=$mes_anterior->copy()->daysInMonth; $i++){
            $dias[] = $mes_anterior->copy()->day($i);
        }
        for ($i=0; $i<$dias_no_mes; $i++){
            $dias[] = $mes_atual->copy()->addDays($i);
        }
        for ($i=1; $i<=(6-$ultimo_dia); $i++){
            $dias[] = $mes_posterior->copy()->day($i);
        }

        foreach ($dias as $dia){
            $calendario[] = $this->comporDia($dia);
        }

        return $calendario;
    }


    public function comporDia(Carbon $data)
    {
        /** @var $horario_repository HorarioInterface */
        $horario_repository = app(HorarioInterface::class);

        $tempo_habil = $horario_repository->tempoHabil($data, $this->model());
        if ($tempo_habil > 0){
            $habilitado = true;
            $ocupacao = $this->calcularOcupacao($data, $tempo_habil);
        } else {
            $habilitado = false;
            $ocupacao = 0;
        }

        return [
            'data' => $data,
            'ocupacao' => $ocupacao,
            'habilitado' => $habilitado,
        ];
    }


    public function calcularOcupacao(Carbon $data, $tempo_habil)
    {
        /** @var $consulta_repository ConsultaInterface */
        $consulta_repository = app(ConsultaInterface::class);

        $ocupado = 0;
        $consultas = $consulta_repository->todasData($data, $this->model());

        foreach ($consultas as $consulta){
            $duracao_consulta  = new Carbon($consulta->duracao);
            $ocupado += $duracao_consulta->minute;
        }

        return (int) (100 / $tempo_habil * $ocupado);
    }
}
