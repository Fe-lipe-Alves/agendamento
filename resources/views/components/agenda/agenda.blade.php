<input type="hidden" value="{{ $agenda->id }}" id="input_agenda_id">

<div class="col">
    <div class="row px-3">
        <div class="col-12 d-flex justify-content-between border-bottom py-2">
            <div class="d-flex align-self-center">
                <button class="btn btn-sm" data-toggle="tooltip" title="Dezembro 2020"><i class="fas fa-chevron-left"></i></button>
                <H4 class="text-center d-inline-block mb-0 mx-2">Janeiro 2021</H4>
                <button class="btn btn-sm" data-toggle="tooltip" title="Fevereiro 2021"><i class="fas fa-chevron-right"></i></button>
            </div>
            <button class="btn btn-sm btn-primary" id="btn-agendar-horario">Agendar Horário</button>
        </div>
    </div>
    <div class="row p-2 p-md-5">
        @includeIf('components.agenda.calendario', ['data' => $data, 'calendario' => $calendario])
    </div>
</div>

@push('scripts')
    <script>
        var rota_informacoes_dia = "{{ route('agenda.informacoes-dia') }}";
    </script>
@endpush


