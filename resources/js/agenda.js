import {alertar} from "@/app";

var moment = require('moment'); // require
moment().format();


function abrirDetalhesDia(data){
    $('#detalhes').fadeIn('fast');
    $('#btn-agendar-horario').hide();

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
    $('.dia, #btn-agendar-horario').on('click', function(){
        abrirDetalhesDia($(this).data('data'));
    });

    $('#fechar-detalhes').on('click', function (){
        $('#detalhes').fadeOut('fast');
        $('#btn-agendar-horario').show();
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
