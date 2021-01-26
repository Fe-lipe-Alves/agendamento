function abrirDetalhesDia(data){
    $('#detalhes').fadeIn('fast');
    $('#btn-agendar-horario').hide();
console.log(data);
    $.ajax({
        url: rota_informacoes_dia,
        type: 'get',
        data: {'data': data, 'agenda': $('#input_agenda_id').val()},
        dataType: 'html',
        success: function (response) {
            $('#detalhes').html(response);
        }
    });
}

$(document).ready(function() {
    $(document).on('click', '.dia', function(){
        abrirDetalhesDia($(this).attr('data-data'));
    });

    $(document).on('click', '#fechar-detalhes', function (){
        $('#detalhes').fadeOut('fast');
        $('#btn-agendar-horario').show();
    });

    $(document).on('click', '.horario', function(){
        $($('#informacoes')).fadeIn('fast');
        $($('#horarios')).fadeOut('fast');
    });

    $(document).on('click', '#ver-todos-horarios', function(){
        $($('#informacoes')).fadeOut('fast');
        $($('#horarios')).fadeIn('fast');
    });
});
