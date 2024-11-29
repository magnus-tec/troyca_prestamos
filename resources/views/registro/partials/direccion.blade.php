
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Dirección Domiciliaria</h2>
        <p class="text-gray-600">Complete la información de residencia del socio</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('registro.direccion.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Departamento -->
                <div>
                    <label for="departamento" class="block text-sm font-medium text-gray-700 mb-2">
                        Departamento
                    </label>
                    <input type="text" id="departamento" name="departamento" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Provincia -->
                <div>
                    <label for="provincia" class="block text-sm font-medium text-gray-700 mb-2">
                        Provincia
                    </label>
                    <input type="text" id="provincia" name="provincia" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Distrito -->
                <div>
                    <label for="distrito" class="block text-sm font-medium text-gray-700 mb-2">
                        Distrito
                    </label>
                    <input type="text" id="distrito" name="distrito" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Tipo de Vivienda -->
                <div>
                    <label for="tipo_vivienda" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Vivienda
                    </label>
                    <select id="tipo_vivienda" name="tipo_vivienda" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                        <option value="">Seleccione...</option>
                        <option value="propia">Propia</option>
                        <option value="alquilada">Alquilada</option>
                        <option value="familiar">Familiar</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <!-- Dirección -->
                <div class="md:col-span-2">
                    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">
                        Dirección
                    </label>
                    <input type="text" id="direccion" name="direccion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Referencia -->
                <div class="md:col-span-2">
                    <label for="referencia" class="block text-sm font-medium text-gray-700 mb-2">
                        Referencia
                    </label>
                    <input type="text" id="referencia" name="referencia" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                        Teléfono
                    </label>
                    <input type="tel" id="telefono" name="telefono" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
                </div>

                <!-- Correo -->
                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">
                        Correo Electrónico
                    </label>
                    <input type="email" id="correo" name="correo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500">
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
