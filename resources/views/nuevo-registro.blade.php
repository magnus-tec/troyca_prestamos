@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Nuevo Registro de Socio</h2>
        <p class="text-gray-600">Complete la información en cada sección</p>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <!-- Navegación por pestañas -->
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6">
                <a href="{{ route('registro.datos-personales') }}"
                    class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab == 'datos-personales' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i data-lucide="user" class="w-5 h-5 mr-2 {{ $activeTab == 'datos-personales' ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Datos Personales
                </a>

                <a href="{{ route('registro.direccion') }}"
                    class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab == 'direccion' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i data-lucide="home" class="w-5 h-5 mr-2 {{ $activeTab == 'direccion' ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Dirección Domiciliaria
                </a>

                <a href="{{ route('registro.laboral') }}"
                    class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab == 'laboral' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i data-lucide="briefcase" class="w-5 h-5 mr-2 {{ $activeTab == 'laboral' ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Información Laboral
                </a>

                <a href="{{ route('registro.conyuge') }}"
                    class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab == 'conyuge' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i data-lucide="users" class="w-5 h-5 mr-2 {{ $activeTab == 'conyuge' ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Datos del Cónyuge
                </a>

                <a href="{{ route('registro.beneficiarios') }}"
                    class="group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab == 'beneficiarios' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i data-lucide="heart" class="w-5 h-5 mr-2 {{ $activeTab == 'beneficiarios' ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Beneficiarios
                </a>
            </nav>
        </div>

        <!-- Contenido de la sección actual -->
        <div class="p-6">
            @if($activeTab == 'datos-personales')
                @include('registro.partials.datos-personales')
            @elseif($activeTab == 'direccion')
                @include('registro.partials.direccion')
            @elseif($activeTab == 'laboral')
                @include('registro.partials.laboral')
            @elseif($activeTab == 'conyuge')
                @include('registro.partials.conyuge')
            @elseif($activeTab == 'beneficiarios')
                @include('registro.partials.beneficiarios')
            @endif
        </div>
    </div>
</div>
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Éxito!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@endsection