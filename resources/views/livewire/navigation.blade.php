<nav class="bg-gray-800" id="main-nav">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            {{-- Mobile menu button --}}
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button type="button" id="mobile-button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
                    Icon when menu is closed.
        
                    Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                    Icon when menu is open.
        
                    Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                {{-- Logotipo --}}
                <a href="/" class="flex flex-shrink-0 items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    <span class="text-white text-lg ml-2">Company Name</span>
                </a>
                {{-- Menu-lg-enlaces --}}
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        @foreach ($categories as $category)
                            <a href="{{route('posts.category', $category)}}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- esta directiva se encargará de confirmar si el usuario esta autenticado y si lo esta, entonces mostrará el contenido del 'div' --}}
            {{-- si no lo esta, entonces mostrará los 'div' de la directiva @else --}}
            @auth
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <span class="hidden sm:block text-sm text-green-300 cursor-default mr-2"
                    >
                        {{ Auth::user()->name }}
                    </span>
        
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" id="user-menu-button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="foto de perfil">
                            </button>
                        </div>
                  
                        <div id="user-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Tu perfil</a>
                            <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" @click.prevent="$root.submit();">
                                    Cerrar sesión
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="hidden sm:flex sm:justify-center sm:items-center sm:gap-x-2">
                    <a 
                        href="{{route('login')}}" 
                        class="text-gray-300 hover:bg-gray-700 hover:text-white 
                        rounded-md px-3 py-2 text-sm font-medium"
                    >
                        Login
                    </a>
                    <a 
                        href="{{route('register')}}" 
                        class="text-gray-300 hover:bg-gray-700 hover:text-white 
                        rounded-md px-3 py-2 text-sm font-medium"
                    >
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 tracking-wider">
            @auth
                <span class="text-sm text-green-300 cursor-default">
                    {{ Auth::user()->name }}
                </span>
            @else
                <div class="flex justify-start items-center sm:gap-x-2">
                    <a 
                        href="{{route('login')}}" 
                        class="text-green-300 hover:bg-gray-700 hover:text-white 
                        rounded-md px-3 py-2 text-sm"
                    >
                        Login
                    </a>
                    <a 
                        href="{{route('register')}}" 
                        class="text-green-300 hover:bg-gray-700 hover:text-white 
                        rounded-md px-3 py-2 text-sm"
                    >
                        Register
                    </a>
                </div>
            @endauth
            @foreach ($categories as $category)
                <a 
                    href="{{route('posts.category', $category)}}" 
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block 
                    rounded-md px-3 py-2 text-sm"
                >
                    {{$category->name}}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener elementos del DOM
        const mobileMenuButton = document.querySelector('.absolute.left-0 button');
        const mobileMenu = document.getElementById('mobile-menu');
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        // Establecer el estado inicial del menú móvil como cerrado
        let isMobileMenuOpen = false;
        toggleMenu(mobileMenu, isMobileMenuOpen); // Ocultar el menú móvil inicialmente

        // Manejar el clic en el botón del menú móvil
        mobileMenuButton.addEventListener('click', function() {
            isMobileMenuOpen = !isMobileMenuOpen;
            toggleMenu(mobileMenu, isMobileMenuOpen);
        });

        // Manejar clics en los enlaces del menú móvil
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                isMobileMenuOpen = false;
                toggleMenu(mobileMenu, isMobileMenuOpen);
            });
        });

        // Manejar clics fuera del menú para cerrarlo
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                toggleMenu(mobileMenu, false);
                isMobileMenuOpen = false;
            }
        });

        // Manejar el clic en el botón del menú de usuario si está presente
        if (userMenuButton && userMenu) {
            let isUserMenuOpen = false;
            toggleMenu(userMenu, isUserMenuOpen); // Ocultar el menú de usuario inicialmente

            userMenuButton.addEventListener('click', function() {
                isUserMenuOpen = !isUserMenuOpen;
                toggleMenu(userMenu, isUserMenuOpen);
            });

            // Manejar clics fuera del menú de usuario para cerrarlo
            document.addEventListener('click', function(event) {
                if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    toggleMenu(userMenu, false);
                    isUserMenuOpen = false;
                }
            });
        }
    });

    // Función para mostrar/ocultar un menú
    function toggleMenu(menu, open) {
        menu.setAttribute('data-open', open);
        const isOpen = menu.getAttribute('data-open') === 'true';
        if (isOpen) {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }
</script>