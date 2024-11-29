
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Datos del Cónyuge</h2>
        <p class="text-gray-600">Complete la información del cónyuge del socio (si aplica)</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('registro.conyuge.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Apellidos y Nombres -->
                <div class="md:col-span-2">
                    <label for="nombre_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        Apellidos y Nombres
                    </label>
                    <input type="text" id="nombre_conyuge" name="nombre_conyuge" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- DNI -->
                <div>
                    <label for="dni_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        DNI N°
                    </label>
                    <input type="text" id="dni_conyuge" name="dni_conyuge" maxlength="8" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label for="fecha_nacimiento_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Nacimiento
                    </label>
                    <input type="date" id="fecha_nacimiento_conyuge" name="fecha_nacimiento_conyuge" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Celular -->
                <div>
                    <label for="celular_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        Celular
                    </label>
                    <input type="tel" id="celular_conyuge" name="celular_conyuge" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Ocupación -->
                <div>
                    <label for="ocupacion_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        Ocupación
                    </label>
                    <input type="text" id="ocupacion_conyuge" name="ocupacion_conyuge" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Dirección -->
                <div class="md:col-span-2">
                    <label for="direccion_conyuge" class="block text-sm font-medium text-gray-700 mb-2">
                        Dirección
                    </label>
                    <input type="text" id="direccion_conyuge" name="direccion_conyuge" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" onclick="history.back()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Atrás
                </button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                    Guardar y Continuar
                </button>
            </div>
        </form>
    </div>
</div>
