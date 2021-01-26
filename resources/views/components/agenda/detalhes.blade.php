<i id="fechar-detalhes" class="fas fa-times float-right mt-n4 mx-1 cursor-pointer" title="Fechar"></i>

<div class="row px-3">
    <div class="col-12 py-2">
        <h4 class="text-center mb-0">15 jan. 2021</h4>
    </div>
{{--        <div class="col-12">--}}
{{--            <div class="row text-center">--}}
{{--                <div id="btn-abrir-horario" class="aba-ativa col-6 border-right-0 border py-1 cursor-pointer" data-aba="#horarios">--}}
{{--                    <span>Horário</span>--}}
{{--                </div>--}}
{{--                <div id="btn-abrir-informacoes" class="col-6 border py-1 cursor-pointer" data-aba="#informacoes">--}}
{{--                    <span>Informações</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    <div id="horarios" class="col-12 mt-4">
        <label class="font-weight-bold">Horários</label>
        <div class="w-100">
            @foreach($consultas as $key => $consulta)
                <div class="w-100 horario border-bottom horario">
                    <p class="m-0 py-2">
                        @php
                            $fragmentos = explode(':', $consulta['duracao']);
                            $termino = date('H:i', strtotime("{$consulta['horario']} + {$fragmentos[0]} hours {$fragmentos[1]} minutes"));
                        @endphp
                        {{ \Carbon\Carbon::make($consulta['horario'])->format('H:i') }} ... {{ $termino }}
                        <button class="btn btn-sm float-right"><i class="fas fa-chevron-down"></i></button>
                        <br/>
                        {{ $consulta['paciente'] }}
                    </p>
                </div>

                @if(isset($consultas[$key+1]))
                    @php
                        $termino_anterior = \Carbon\Carbon::make($termino);
                        $proxima_consulta = \Carbon\Carbon::make($consultas[$key+1]['horario']);
                    @endphp

                    @if($termino_anterior->diffInMinutes($proxima_consulta))
                        <div class="w-100 horario border-bottom horario">
                            <p class="m-0 py-2">
                                {{ $termino_anterior->addMinutes(1)->format('H:i') }}
                                ...
                                {{ $proxima_consulta->subMinutes(1)->format('H:i') }}
                                <button class="btn btn-sm float-right"><i class="fas fa-plus"></i></button>
                                <br/>
                                <span class="text-success font-weight-bold">
                                    <small><i class="fas fa-circle"></i></small> Disponível
                                </span>
                            </p>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    <div id="informacoes" class="col-12 display-none mt-4 pt-2">
        <form action="">
            <div class="form-group">
                <p>Horário: <strong class="info-horario">09:00</strong>
                    <button type="button" id="ver-todos-horarios" class="float-right ver-todos-horarios btn btn-sm btn-outline-primary">Ver todos</button>
                </p>
            </div>
            <div class="form-group">
                <label for="paciente">Paciente</label>
                <input type="text" name="paciente" id="paciente" class="form-control" placeholder="Digite para pesquisar">
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
