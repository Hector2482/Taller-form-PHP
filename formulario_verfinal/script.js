// script.js

$(document).ready(function() {
    $('#pqrsForm').submit(function(e) {
        e.preventDefault(); // Evitar el envío predeterminado del formulario
        
        // Obtener los datos del formulario
        var formData = $(this).serialize();
        // Enviar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'procesar.php', // Ruta a tu script de procesamiento PHP
            data: formData,
            success: function(response) {
                $('#response').html(response);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});