<script>
    $(document).ready(function() {

        $('.laravelForm').on('submit', function(event) {

            event.preventDefault(); // Evita el comportamiento por defecto del formulario

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST', // Aunque el método real es PUT, jQuery AJAX lo maneja como POST
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Redirige a la página especificada en la respuesta, agregando el mensaje de éxito como parámetro
                    var redirectUrl = response.redirect + '?info=' + encodeURIComponent(response.info);
                    window.location.href = redirectUrl;

                    // Limpia el parámetro 'info' de la URL después de mostrar el mensaje
                    limpiarUrl();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    if (errors.name) {
                        $('.error-name').text(errors.name[0]);
                    } else {
                        $('.error-name').text('');
                    }
                    if (errors.slug) {
                        $('.error-slug').text(errors.slug[0]);
                    } else {
                        $('.error-slug').text('');
                    }
                    if (errors.category_id) {
                        $('.error-category_id').text(errors.category_id[0]);
                    } else {
                        $('.error-category_id').text('');
                    }
                    if (errors.tags) {
                        $('.error-tags').text(errors.tags[0]);
                    } else {
                        $('.error-tags').text('');
                    }
                    if (errors.status) {
                        $('.error-status').text(errors.status[0]);
                    } else {
                        $('.error-status').text('');
                    }
                    if (errors.extract) {
                        $('.error-extract').text(errors.extract[0]);
                    } else {
                        $('.error-extract').text('');
                    }
                    if (errors.body) {
                        $('.error-body').text(errors.body[0]);
                    } else {
                        $('.error-body').text('');
                    }
                    if (errors.file) {
                        $('.error-file').text(errors.file[0]);
                    } else {
                        $('.error-file').text('');
                    }
                }
            });
        });

        // Mostrar el mensaje de éxito si está presente en la URL después de la redirección
        var urlParams = new URLSearchParams(window.location.search);
        var info = urlParams.get('info');
        if (info) {
            mostrarMensajeExito(info);
            limpiarUrl();  // Limpia el parámetro 'info' de la URL después de mostrar el mensaje
        }

        // Función para mostrar el mensaje de éxito
        function mostrarMensajeExito(info) {
            $('.alert-success').remove(); // Eliminar cualquier alerta de éxito existente para evitar duplicados
            var alertDiv = $('<div class="alert alert-success"><strong>' + decodeURIComponent(info) + '</strong></div>');
            $('.contentAlert').prepend(alertDiv); // Asegúrate de que la clase 'contentAlert' exista en el contenedor principal
        }

        // Función para limpiar el parámetro 'info' de la URL
        function limpiarUrl() {
            var newUrl = window.location.href.split('?')[0];
            history.replaceState({}, document.title, newUrl);
        }
    });
</script>