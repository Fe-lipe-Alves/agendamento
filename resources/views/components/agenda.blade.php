<div id="agenda" class="col-12">
    @for($i=0; $i<count($calendario); $i++)
        <div class="semana row">
            @for($j=1; $j<=7 && $i<count($calendario); $j++)
                    <div class="dia col ocupacao-{{ $calendario[$i]['ocupacao'] }} {{ ($j==1 || $j==7)?'fim_de_semana':'' }}
                          {{ ($data->month != $calendario[$i]['data']->month)?'mutado':'' }}
                         {{ ($calendario[$i]['habilitado'] != true)?$calendario[$i]['habilitado']:'' }}
                         {{ $calendario[$i]['data']->day==15?'feriado':'' }}"
                         data-dia="{{ $calendario[$i]['data']->day }}" data-data="{{ $calendario[$i]['data']->format('Y-m-d') }}"
                         data-ocupacao="{{ $calendario[$i]['ocupacao'] }}">
                    </div>
                @if($j<7)
                    @php($i++)
                @endif
            @endfor
        </div>
    @endfor
</div>


