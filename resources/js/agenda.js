import {alertar} from "@/app";

var moment = require('moment'); // require
moment().format();

/**
 * Muda a aba Detalhes para a aba referente ao botão recebido
 * @param button_aba
 */
function mudarAbaDetalhes(button_aba){
    let aba = button_aba.addClass('aba-ativa').data('aba');
    $(aba).fadeIn('fast');

    button_aba.siblings().each(function(){
        let aba_ocultar = $(this).removeClass('aba-ativa').data('aba');
        $(aba_ocultar).fadeOut('fast');
    });
}

function abrirDetalhesDia(data){
    $('#detalhes').fadeIn('fast');

    $.ajax({
        url: '', // ToDo // Mudar link para a rota real
        type: 'get',
        data: {'data': data},
        dataType: 'json',
        success: function (response) {
            if (response.success === true){

            } else {

            }
        }
    });
}

$(document).ready(function() {
    $('#btn-abrir-informacoes').on('click', function(){
        mudarAbaDetalhes($(this));
    });

    $('#btn-abrir-horario').on('click', function(){
        mudarAbaDetalhes($(this));
    });

    $('.dia').on('click', function(){
        abrirDetalhesDia($(this).data('data'));
    });

    $('#fechar-detalhes').on('click', function (){
        $('#detalhes').fadeOut('fast');
    });

    $('.horario').on('click', function(){
        $($('#informacoes')).fadeIn('fast');
        $($('#horarios')).fadeOut('fast');
    });

    $('#ver-todos-horarios').on('click', function(){
        $($('#informacoes')).fadeOut('fast');
        $($('#horarios')).fadeIn('fast');
    });
});
