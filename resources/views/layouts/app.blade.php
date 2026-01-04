<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mi Sitio')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="https://img.freepik.com/foto-gratis/mujer-trabajando-remotamente-casa_23-2150192195.jpg?semt=ais_hybrid&w=740&q=80"fetchpriority="high"
/>

    {{-- Importa los assets compilados --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (si no está ya incluido) -->
    <!-- Agrega esto en tu <head> -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome (para iconos) -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->

</head>
<body class="bg-gray-50 text-gray-900 h-dvh pt-16 md:pt-[104px]">

    {{-- NAVBAR --}}
    <x-navbar />


    {{-- CONTENIDO --}}
    <main class="">
        @yield('content')
    </main>
    
    <x-whatsapp />

    {{-- FOOTER --}}
    <x-footer />

</body>
</html>
