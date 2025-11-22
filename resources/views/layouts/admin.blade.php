<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
</head>
<body class="bg-gray-100 font-sans">

<div x-data="{ sidebarOpen: true }" class="flex h-screen">

    <!-- Sidebar -->
    <aside 
        :class="sidebarOpen ? 'w-64' : 'w-20'" 
        class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col">

        <!-- Logo / botón minimizar -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
            <span :class="sidebarOpen ? 'text-lg font-bold' : 'hidden'">MiPanel</span>
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Navegación -->
        <nav class="flex-1 px-2 py-4 space-y-2 overflow-auto">
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 transition">
                <i class="fa-solid fa-house mr-3"></i>
                <span x-show="sidebarOpen" class="transition-all duration-300">Dashboard</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 transition">
                <i class="fa-solid fa-users mr-3"></i>
                <span x-show="sidebarOpen" class="transition-all duration-300">Usuarios</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 transition">
                <i class="fa-solid fa-file-lines mr-3"></i>
                <span x-show="sidebarOpen" class="transition-all duration-300">Posts</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-indigo-50 hover:text-indigo-600 transition">
                <i class="fa-solid fa-gear mr-3"></i>
                <span x-show="sidebarOpen" class="transition-all duration-300">Configuración</span>
            </a>
        </nav>

    </aside>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-64' : 'ml-20'">

        <!-- Header -->
        <header class="h-16 flex items-center px-6 bg-white border-b border-gray-200 shadow-sm">
            <h1 class="text-xl font-semibold text-gray-800">Panel de Administración</h1>
        </header>

        <!-- Main -->
        <main class="flex-1 p-6 overflow-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold mb-4">Bienvenido al panel</h2>
                <p>Contenido principal aquí. Puedes agregar tablas, gráficos, formularios y más.</p>
            </div>
        </main>

    </div>
</div>

<!-- Alpine.js para interactividad -->
<script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
