<script>
    function eliminarAcentos(texto) {
        return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    $(document).ready(function() {
        $('.name').on('input', function() {
            // Elimina caracteres no deseados y acentos
            var cleanedText = eliminarAcentos($(this).val()).replace(/[^a-zA-Z0-9\s]/g, '');
            // Convierte el texto a minúsculas y reemplaza los espacios con guiones
            var slug = cleanedText.toLowerCase().trim().replace(/\s+/g, '-');
            $('.slug').val(slug);
        });
    });
</script>