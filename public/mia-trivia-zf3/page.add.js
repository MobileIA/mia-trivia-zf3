$(document).ready(function(){
    $('#trivia').submit(function(){
        // Verificar si escribio un titulo
        if($("input[name='title']").val() == ''){
            alert('Debe ingresar la pregunta de la trivia.');
            return false;
        }
        // Verificar si se cargo una fecha de inicio y fin
        if($("input[name='start_date']").val() == '' || $("input[name='end_date']").val() == ''){
            alert('Complete las fechas.');
            return false;
        }
        // Verificar si cargo dos respuestas como minimo
        var has_options = 0;
        $('.input_option_title').each(function(index, element){
            if($(element).val() != ''){
                has_options++;
            }
        });
        if(has_options <= 1){
            alert('Debe cargar dos respuetas como minimo');
            return false;
        }
        // Recorrer todas las respuestas
        var has_correct = false;
        $('.select_is_correct').each(function(index, element){
            if($(element).val() == 1){
                has_correct = true;
            }
        });
        if(!has_correct){
            alert('Debe seleccionar una respuesta como correcta.');
            return false;
        }
        
        return true;
    });
});

function changeIsCorrect(element){
    // Obtener valor del elemento cambiado
    var value = $(element).val();
    // Verificar si es correcto
    if(value == 1){
        $('.select_is_correct').val(0);
        $(element).val(1);
    }
    
    return false;
}