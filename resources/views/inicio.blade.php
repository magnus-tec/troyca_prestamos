@extends('layouts.app')

@section('content')
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Tarjeta de Préstamos Activos -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
            <i data-lucide="credit-card" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">
                Préstamos Activos
            </p>
            <p class="text-lg font-semibold text-gray-700">
                45
            </p>
        </div>
    </div>
    <!-- Tarjeta de Total Prestado -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
            <i data-lucide="dollar-sign" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">
                Total Prestado
            </p>
            <p class="text-lg font-semibold text-gray-700">
                S/. 46,760.89
            </p>
        </div>
    </div>
    <!-- Tarjeta de Socios Activos -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
            <i data-lucide="users" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">
                Socios Activos
            </p>
            <p class="text-lg font-semibold text-gray-700">
                376
            </p>
        </div>
    </div>
    <!-- Tarjeta de Pagos Pendientes -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">
                Pagos Pendientes
            </p>
            <p class="text-lg font-semibold text-gray-700">
                35
            </p>
        </div>
    </div>
</div>

<!-- Gráficos y Tablas -->
<div class="grid gap-6 mb-8 md:grid-cols-2">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
        <h4 class="mb-4 font-semibold text-gray-800">
            Préstamos Recientes
        </h4>
        <div class="overflow-hidden overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Monto</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Fecha</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                Juan Pérez
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            S/. 2,000.00
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Aprobado
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            15-01-2024
                        </td>
                    </tr>
                    <!-- Más filas aquí -->
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
        <h4 class="mb-4 font-semibold text-gray-800">
            Pagos del Mes
        </h4>
        <div class="overflow-hidden overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                        <th class="px-4 py-3">Socio</th>
                        <th class="px-4 py-3">Monto</th>
                        <th class="px-4 py-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm">
                            María García
                        </td>
                        <td class="px-4 py-3 text-sm">
                            S/. 500.00
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">
                                Pendiente
                            </span>
                        </td>
                    </tr>
                    <!-- Más filas aquí -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection