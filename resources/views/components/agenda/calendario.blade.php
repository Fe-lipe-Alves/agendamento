<div id="agenda" class="col-12">
    @for($i=0; $i<count($calendario); $i++)
        <div class="semana row">
            @for($j=1; $j<=7 && $i<count($calendario); $j++)
                @php
                    $classes = '';

                    $classes.=" ocupacao-".$calendario[$i]['ocupacao'];
                    if ($j==1 || $j==7)
                        $classes.=" fim_de_semana";

                    if ($data->month != $calendario[$i]['data']->month)
                        $classes.=" mutado";

                    if ($calendario[$i]['habilitado'] != true)
                        $classes.=' '.$calendario[$i]['habilitado'];

                    if ($calendario[$i]['data']->month == $data->month && $calendario[$i]['data']->day < $data->day)
                        $classes.=" passado";

                    if ($calendario[$i]['evento']->count() > 0)
                        $classes.=" ".$calendario[$i]['evento']->first()->titulo;
                @endphp

                <div class="dia col p-0 {{ ($calendario[$i]['data']->equalTo(\Carbon\Carbon::now()))?'hoje':'' }}"
                     data-data="{{ $calendario[$i]['data']->format('Y-m-d') }}">
                    <div class="cabecalho {{ $classes }}"
                         data-toggle="tooltip" data-placement="left" title="{{ $calendario[$i]['ocupacao']."-". $calendario[$i]['disponivel'] }}"
                         data-ocupacao="{{ $calendario[$i]['ocupacao'] }}" data-dia="{{ $calendario[$i]['data']->day }}">
                    </div>
                </div>
                @if($j<7)
                    @php($i++)
                @endif
            @endfor
        </div>
    @endfor
</div>
