<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación Laravel</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navegación -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/" class="flex items-center py-4">
                            <span class="font-semibold text-gray-500 text-lg">Mi App</span>
                        </a>
                    </div>
                    <!-- Enlaces de navegación -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('inicio') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Inicio</a>
                        <a href="{{ route('servicios') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Servicios</a>
                        <a href="{{ route('productos') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Productos</a>
                        <a href="{{ route('contacto') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Contacto</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>
</body>
</html>