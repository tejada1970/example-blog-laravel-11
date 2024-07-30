<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Características

**Uso de base de datos:** Este proyecto necesita de una base de datos relacional (MySQL) para poder gestionar el contenido del blog, permitiendo almacenar, editar y eliminar publicaciones de manera eficiente.

**Requisitos del servidor:** Para su correcto funcionamiento, el proyecto debe ejecutarse desde un servidor. Se recomienda utilizar XAMPP u otro servidor local para alojar la aplicación.

**Es importante tener en cuenta que el propósito de este proyecto es demostrar cómo crear un blog personal y está destinado únicamente a fines prácticos y educativos.**

## Uso

**Descarga:** Descarga el proyecto utilizando la opción Download ZIP desde el botón Code o clona el repositorio utilizando la terminal de Git.

**Crear la base de datos:** Para garantizar el correcto funcionamiento del blog, se debe crear una base de datos (en este ejemplo se utiliza phpMyAdmin de Apache). Abre el panel de control de Apache como administrador, enciende Apache y MySQL, luego abre phpMyAdmin y crea una base de datos con el siguiente nombre:

- example-blog-laravel-11

**Configurar variables de entorno del proyecto:** Modifica las siguientes variables de entorno en el archivo .env del proyecto para almacenar y acceder a los datos registrados en la base de datos:
   
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=example-blog-laravel-11
- DB_USERNAME=root  # Si tu nombre de usuario no es root, pon el que corresponda
- DB_PASSWORD=      # Pon aquí tu contraseña para acceder a la base de datos. Si no tienes contraseña, déjalo en blanco
   

**Inicializar y poblar la base de datos:** Abre la terminal en tu editor preferido (se recomienda Visual Studio Code) y ejecuta los siguientes comandos para inicializar y poblar la base de datos con datos ficticios:

- **Inicializa vite:** npm run dev

- **Arranca el servidor PHP:** php artisan serve

- **Ejecuta los seeders:** php artisan migrate:fresh --seed


**Crear enlace simbólico para almacenamiento:** Asegúrate de que la carpeta public del proyecto contiene un enlace simbólico a storage para que se cree una copia de la carpeta posts con todas las imágenes de las publicaciones. Si no existe, crea el enlace ejecutando el siguiente comando desde la terminal de tu editor:

- php artisan storage:link


**Credenciales de acceso:** En el archivo database/seeders/UserSeeder.php del proyecto, se especifican las siguientes credenciales para el primer registro de la tabla de usuarios. Puedes personalizar estos datos para ingresar sin necesidad de registrarte:

```
'name' => 'Mi nombre',
'email' => 'micorreo@gmail.com',
'password' => bcrypt('12345678')
```