<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mi Sitio')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Importa los assets compilados --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (si no está ya incluido) -->
    <!-- Agrega esto en tu <head> -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome (para iconos) -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->

</head>
<body class="bg-gray-50 text-gray-900 h-dvh pt-20">

    {{-- NAVBAR --}}
    <x-navBar />


    {{-- CONTENIDO --}}
    <main class="">
        @yield('content')
    </main>
    
    <x-whatsapp />

    {{-- FOOTER --}}
    <x-footer />

</body>
</html>
