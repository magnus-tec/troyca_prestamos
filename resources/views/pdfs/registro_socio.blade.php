<!-- resources/views/pdfs/registro_socio.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Registro de Socio</h1>
    <p class="mb-4"><strong>N° DE SOCIO:</strong> {{ $registro->numero_socio }}</p>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Datos Personales</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Apellido Paterno:</strong> {{ $registro->datosPersonales->apellido_paterno }}</p>
            <p><strong>Apellido Materno:</strong> {{ $registro->datosPersonales->apellido_materno }}</p>
            <p><strong>Nombres:</strong> {{ $registro->datosPersonales->nombres }}</p>
            <p><strong>DNI:</strong> {{ $registro->datosPersonales->dni }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $registro->datosPersonales->fecha_nacimiento->format('d/m/Y') }}</p>
            <p><strong>Estado Civil:</strong> {{ $registro->datosPersonales->estado_civil }}</p>
            <p><strong>Profesión u Ocupación:</strong> {{ $registro->datosPersonales->profesion_ocupacion }}</p>
            <p><strong>Nacionalidad:</strong> {{ $registro->datosPersonales->nacionalidad }}</p>
            <p><strong>Sexo:</strong> {{ $registro->datosPersonales->sexo }}</p>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Dirección Domiciliaria</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Departamento:</strong> {{ $registro->direccion->departamento }}</p>
            <p><strong>Provincia:</strong> {{ $registro->direccion->provincia }}</p>
            <p><strong>Distrito:</strong> {{ $registro->direccion->distrito }}</p>
            <p><strong>Dirección:</strong> {{ $registro->direccion->direccion }}</p>
            <p><strong>Referencia:</strong> {{ $registro->direccion->referencia }}</p>
            <p><strong>Teléfono:</strong> {{ $registro->direccion->telefono }}</p>
            <p><strong>Correo:</strong> {{ $registro->direccion->correo }}</p>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Información Laboral</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Situación:</strong> {{ $registro->informacionLaboral->situacion }}</p>
            <p><strong>Institución/Empresa:</strong> {{ $registro->informacionLaboral->institucion_empresa }}</p>
            <p><strong>Dirección Laboral:</strong> {{ $registro->informacionLaboral->direccion_laboral }}</p>
            <p><strong>Teléfono Laboral:</strong> {{ $registro->informacionLaboral->telefono_laboral }}</p>
            <p><strong>Cargo:</strong> {{ $registro->informacionLaboral->cargo }}</p>
        </div>
    </section>

    @if($registro->conyuge)
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Datos del Cónyuge</h2>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Apellidos y Nombres:</strong> {{ $registro->conyuge->apellidos_nombres }}</p>
            <p><strong>DNI:</strong> {{ $registro->conyuge->dni }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $registro->conyuge->fecha_nacimiento->format('d/m/Y') }}</p>
            <p><strong>Celular:</strong> {{ $registro->conyuge->celular }}</p>
            <p><strong>Ocupación:</strong> {{ $registro->conyuge->ocupacion }}</p>
            <p><strong>Dirección:</strong> {{ $registro->conyuge->direccion }}</p>
        </div>
    </section>
    @endif

    @if($registro->beneficiarios->count() > 0)
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Beneficiarios</h2>
        @foreach($registro->beneficiarios as $beneficiario)
        <div class="grid grid-cols-2 gap-4 mb-4">
            <p><strong>Apellidos y Nombres:</strong> {{ $beneficiario->apellidos_nombres }}</p>
            <p><strong>DNI:</strong> {{ $beneficiario->dni }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $beneficiario->fecha_nacimiento->format('d/m/Y') }}</p>
            <p><strong>Parentesco:</strong> {{ $beneficiario->parentesco }}</p>
            <p><strong>Sexo:</strong> {{ $beneficiario->sexo }}</p>
        </div>
        @endforeach
    </section>
    @endif

    <div class="mt-8 text-center">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Imprimir Registro
        </button>
    </div>
</div>
@endsection