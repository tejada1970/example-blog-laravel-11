<x-app-layout>

    {{-- todo lo que escribamos dentro de estas etiquetas se renderizará en app.blade.php
    a traves de la variable ($slot) dentro de este fragmento de codigo: --}}
    
    <!-- Page Content (resources/views/layouts/app.blade.php) -->
    <main>
        {{ $slot }}
    </main>
   
</x-app-layout>
