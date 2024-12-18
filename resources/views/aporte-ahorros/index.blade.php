@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Registro de aportes</h2>
        <a href="{{ route('registrar-aporte') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
            <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
            Agregar Nuevo aporte
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Lista de socios registrados -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombres y Apellidos
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total de Aportes
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($aportes as $aporte)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $aporte->registroSocio->datosPersonales->apellido_paterno }} {{ $aporte->registroSocio->datosPersonales->apellido_materno }} {{ $aporte->registroSocio->datosPersonales->nombres }} 
                            </div>
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $aporte->total_aportes }} 
                            </div>
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $aporte->estado == 'activo' ? 'activo' : 'inactivo' }}
                            </span>
                        </td>  --}}
                    
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- <a href="{{ route('prestamo-pagar', $aporte->id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 mr-3" target="_blank">
                                Pagar
                            </a> --}}
                            <a href="{{ route('aporte-pdf', $aporte->id) }}" 
                               class="text-green-600 hover:text-green-900 mr-3" target="_blank">
                                PDF
                            </a>
                            {{-- <form action="{{ route('register.destroy', $aporte->id) }}" 
                                  method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Está seguro de eliminar este register?')">
                                    Eliminar
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No hay registers disponibles
                        </td>
                    </tr>
                @endforelse 
            </tbody>
        </table>
    </div>
</div>
@endsection