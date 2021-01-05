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
            <div class="col-12 py-2">
                <h4 class="text-center mb-0">15 jan. 2021</h4>
            </div>
            <div class="col-12">
                <div class="row text-center">
                    <div id="btn-abrir-horario" class="col-6 border-right-0 border py-1 cursor-pointer">
                        <span>Horário</span>
                    </div>
                    <div id="btn-abrir-informacoes" class="col-6 border py-1 cursor-pointer">
                        <span>Informações</span>
                    </div>
                </div>
            </div>
            <div id="horarios" class="col-12 d-none mt-4">
                <label class="font-weight-bold">Horários</label>
                <div class="w-100">
                    @for($i=0; $i<18; $i++)
                        <div class="w-100 horario border-bottom horario">
                            <p class="m-0 py-2">09:00<br/>{!! (bool)rand(0,1)?'Felipe Alves':
                        '<span class="text-success font-weight-bold"><small><i class="fas fa-circle"></i></small> Disponível</span>' !!}</p>
                        </div>
                    @endfor
                </div>
            </div>
            <div id="informacoes" class="col-12 mt-4 pt-2">
                <form action="">
                    <div class="form-group">
                        <p>Horário: <strong class="info-horario">09:00</strong>
                            <span class="text-muted float-right ver-todos-horarios cursor-pointer link">Ver Todos</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="duração">Duração</label>
                            <input type="text" name="duração" id="duração" class="form-control" placeholder="Ex: 00:30" value="00:30">
                        </div>
                        <div class="col-6 form-check pt-4 text-center">
                            <input class="form-check-input" type="checkbox" value="" id="retorno">
                            <label class="form-check-label" for="retorno">Retorno</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="paciente">Paciente</label>
                        <input type="text" name="paciente" id="paciente" class="form-control" placeholder="Digite para pesquisar">
                    </div>
                    <label for="rotulos">Rótulos</label>
                    <div class="input-group form-group">
                        <select class="custom-select form-control" id="rotulos" aria-label="Adicionar rótulo na consulta">
                            <option selected>Selecione...</option>
                            <option value="1">Um</option>
                            <option value="2">Dois</option>
                            <option value="3">Três</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Adicionar</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea name="observacao" id="observacao" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-outline-primary mx-2">Calncelar</button>
                        <input type="submit" class="btn btn-primary mx-2" value="Salvar">
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
