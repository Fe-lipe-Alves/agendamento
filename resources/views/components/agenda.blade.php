<div id="agenda" class="col-12">
    @for($i=0; $i<count($calendario); $i++)
        <div class="semana row">
            @for($j=1; $j<=7 && $i<count($calendario); $j++)
                    <div class="dia col {{ ($data->month != $calendario[$i]->month)?'mutado':'' }}"
                         data-dia="{{ $calendario[$i]->day }}" data-data="{{ $calendario[$i]->format('Y-m-d') }}">
                    </div>
                @if($j<7)
                    @php($i++)
                @endif
            @endfor
        </div>
    @endfor
</div>
