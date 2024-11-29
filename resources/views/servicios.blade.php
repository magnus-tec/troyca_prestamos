@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Nuestros Servicios</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 border rounded">
            <h3 class="font-bold">Servicio 1</h3>
            <p class="text-gray-600">Descripción del servicio 1</p>
        </div>
        <div class="p-4 border rounded">
            <h3 class="font-bold">Servicio 2</h3>
            <p class="text-gray-600">Descripción del servicio 2</p>
        </div>
        <div class="p-4 border rounded">
            <h3 class="font-bold">Servicio 3</h3>
            <p class="text-gray-600">Descripción del servicio 3</p>
        </div>
    </div>
</div>
@endsection