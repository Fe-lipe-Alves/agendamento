@extends('components.base')
@section('title', 'Home')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endsection

@section('content')
    @includeIf('components.menu_lateral')

    <div class="col-12 col-md-9">
        <div class="row px-3">
            <div class="col-12 d-flex justify-content-between border-bottom py-2">
                <div class="d-flex align-self-center">
                    <button class="btn btn-sm" data-toggle="tooltip" title="Dezembro 2020"><i class="fas fa-chevron-left"></i></button>
                    <H4 class="text-center d-inline-block mb-0 mx-2">Janeiro 2021</H4>
                    <button class="btn btn-sm" data-toggle="tooltip" title="Fevereiro 2021"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button class="btn btn-sm btn-primary justify-">Agendar Horário</button>
            </div>
        </div>
        <div class="row p-2 p-md-5">
            @includeIf('components.agenda', ['data' => $data, 'calendario' => $calendario])
        </div>
    </div>
    <div id="detalhes" class="col-12 col-md-3 border-left">
        <div class="row px-3">
            <div class="col-12 py-2 border-bottom">
                <h4 class="text-center mb-0">15 jan. 2021</h4>
            </div>
            <div id="horarios" class="col-12 mt-4">
                <label class="font-weight-bold">Horários</label>
            @for($i=0; $i<18; $i++)
                <div class="w-100 horario border-bottom horario">
                    <p class="m-0 py-2">09:00<br/>{!! (bool)rand(0,1)?'Felipe Alves':
                        '<span class="text-success font-weight-bold"><small><i class="fas fa-circle"></i></small> Disponível</span>' !!}</p>
{{--                    <p class="text-center mb-0"><span title="Expandir"><i class="fas fa-chevron-down"></i></span></p>--}}
                </div>
            @endfor
            </div>
            <div class="col-12 mt-4 pt-2 border-top">
                <form action="">
                    <div class="form-group">
                        <label for="paciente">Paciente</label>
                        <input type="text" name="paciente" id="paciente" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/agenda.js') }}"></script>
    <script src="{{ asset('js/moment/moment.js') }}"></script>
@endsection
