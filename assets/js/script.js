$(function (){
    var resultado = ["Wallace", "Rosana", "Pedro", "Piu", "Pamela", "Ryan"];
    var apresenta = $('.resultado');
    
    apresenta.hide().html('<li style="color:green">Aguarde, carregando...</li>');
    $('.j_autocomplete ').autocomplete({
        source: resultado
    });
});