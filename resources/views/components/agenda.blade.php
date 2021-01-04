<div id="agenda" class="col-12">
    @for($i=0; $i<count($calendario); $i++)
        <div class="semana row">
            @for($j=1; $j<=7 && $i<count($calendario); $j++)
                    <div class="dia col p-0 {{ ($calendario[$i]['data']->format('Y-m-d') == (\Carbon\Carbon::now())->format('Y-m-d'))?'hoje':'' }}">
                        <div class="cabecalho ocupacao-{{ $calendario[$i]['ocupacao'] }} {{ ($j==1 || $j==7)?'fim_de_semana':'' }}
                        {{ ($data->month != $calendario[$i]['data']->month)?'mutado':'' }}
                        {{ ($calendario[$i]['habilitado'] != true)?$calendario[$i]['habilitado']:'' }}
                        {{ ($calendario[$i]['data']->month == $data->month && $calendario[$i]['data']->day < $data->day)?'passado':'' }}
                        {{ $calendario[$i]['data']->day==15?'feriado':'' }}"
                             data-toggle="tooltip" data-placement="left" title="{{ $calendario[$i]['ocupacao'] }}% - 14:10"
                             data-dia="{{ $calendario[$i]['data']->day }}" data-data="{{ $calendario[$i]['data']->format('Y-m-d') }}"
                             data-ocupacao="{{ $calendario[$i]['ocupacao'] }}">
                        </div>
                    </div>
                @if($j<7)
                    @php($i++)
                @endif
            @endfor
        </div>
    @endfor
</div>


