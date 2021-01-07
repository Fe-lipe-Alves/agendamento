var mapa_alertas = new Map();

$(document).ready(function (){
    $('[data-toggle="tooltip"]').tooltip();

    $('#alerta').on('click', '.expandir', function (){
        let alrt = $(this).parents('.alrt');
        alrt.find('.detalhes').slideDown();
        clearTimerAlert(alrt, true);
    })
    .on('click', '.fechar', function (){
        $(this).parents('.alrt').fadeOut(function (){
            $(this).remove();
        });
    })
    .on('mouseenter', '.alrt', function(){
        clearTimerAlert($(this));
    })
    .on('mouseleave', '.alrt', function(){
        setTimerAlert($(this),  5000)
    });
});

/**
 * Gera um ID numérico com o comprimeto informado
 *
 * @param comprimento
 * @returns {number}
 */
function gera_id(comprimento){
    const randomized = Math.ceil(Math.random() * Math.pow(10, comprimento));
    let digito = Math.ceil(Math.log(randomized));
    while(digito > 10)
        digito = Math.ceil(Math.log(digito));
    return parseInt(randomized+''+digito);
}

// Adiciona tempo de exibição do alerta
function setTimerAlert(alerta, tempo = 10000){
    let timerId = setTimeout(function (){
        if (alerta.data('bloqueado') === true)
            return;
        alerta.fadeOut();
    }, tempo);
    mapa_alertas.set(alerta.data('id'), timerId);
}

// Limpa o tempo de exibição do alerta
function clearTimerAlert(alerta, permanente = false){
    let timerId = mapa_alertas.get(alerta.data('id'));
    clearTimeout(timerId);
    if (permanente){
        alerta.attr('data-bloqueado', 'true');
    }
}

/**
 *  Exibe um alerta no topo da página, logo abaixo do menu. Após 10 segundo o alerta desaparece.
 *
 *  Aceita como primeiro parâmetro a mensagem do alerta e segundo parâmetro o tipo do alerta (danger, alert, success).
 *
 * @param mensagem
 * @param tipo
 * @param detalhes
 */
function alertar(mensagem, tipo = "danger", detalhes = ""){
    let id = gera_id(5),
        html =
        '<div data-id="'+id+'" class="col-12 alrt bg-'+tipo+' reticencias py-2 display-none">' +
            '<div class="titulo">' +
                '<p class="m-0">' +
                    mensagem+
                    '<span class="float-right">' +
                        '<i class="fas fa-chevron-down text-muted expandir mx-2" title="Ver Mais"></i>' +
                        '<i class="fas fa-times text-muted fechar mx-2" title="Remover"></i>' +
                    '</span>' +
                '</p>' +
            '</div>' +
            '<div class="detalhes display-none">'+detalhes+'</div>' +
        '</div>';

    const alerta = $(html).appendTo('#alerta').fadeIn();
    setTimerAlert(alerta);
}


/**
 * -----------------------------------------------------------------------
 * Exporta as funções para serem importadas nos arquivos onde forem usadas
 * -----------------------------------------------------------------------
 * As funções ficam disponíveis para os outros arquivos js realizar a
 * importação das funções. Assim, não é necessário todos as funções desse
 * arquivo, somente as necessárias para a página carregada
 */
export {
    alertar,
    gera_id
};
