var moment = require('moment'); // require
moment().format();

function gerarCalendario(data = null){
    if(typeof data === "string"){
        data = new Date(data);
    }

    // variaveis
    var date = moment(data);
    var dia = date.day();
    var mes = date.month();
    var ano = date.year();
    var dia_da_semana = date.weekday();
    var dias_do_mes = date.daysInMonth();
    var html = '';


    if (dia_da_semana > 0){
        for (let i=0; i<dia_da_semana; i++){

        }
    }

}

$(document).ready(function(){


    console.log(dia, mes, ano, dias_do_mes, dia_da_semana);


});
