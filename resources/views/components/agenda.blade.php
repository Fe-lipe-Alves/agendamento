<div id="agenda" class="col-12">
    @php($primeira_semana = true)
    @for($i=1; $i<=$data->daysInMonth; $i++)
        <div class="semana row">
            @for($j=0; $j<7; $j++)
                @if($i > $data->daysInMonth)
                    <div class="dia col" data-dia=""></div>
                    @continue
                @endif

                @if($primeira_semana && $j < $data->firstOfMonth()->dayOfWeek)
                    <div class="dia col" data-dia=""></div>
                    @continue
                @endif

                @php($primeira_semana = false)
                <div class="dia col" data-dia="{{ $i }}">

                </div>

                @if($j<6)
                    @php($i++)
                @endif
            @endfor
        </div>
    @endfor
</div>
