@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <h2 class="text-2xl font-semibold mb-4">Estado de Cuenta - Pagar Préstamo</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Fecha Vencimiento</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Monto Pago</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Estado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPagado = 0;
                    $contador = 1;
                @endphp

                @foreach($cuotas as $cuota)
                    @if($cuota->estado == 1)
                        @php
                            $totalPagado += $cuota->cuota;
                        @endphp
                    @endif

                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">Cuota {{ $contador++ }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $cuota->fecha_pago }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">${{ number_format($cuota->cuota, 2) }}</td>
                        <td class="px-6 py-4">
                            <button class="px-4 py-2 text-xs font-semibold rounded-full 
                                {{ $cuota->estado == 1 ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }} 
                                hover:bg-opacity-80 focus:outline-none" 
                                onclick="cambiarEstado({{ $cuota->id }})">
                                {{ $cuota->estado == 1 ? 'Pagado' : 'Pendiente' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <h4  class="text-lg font-semibold text-gray-800">Total Pagado: $ <span id="total-pagado">{{ number_format($totalPagado, 2) }}</span></h4>
    </div>
</div>
@endsection

<!-- Incluir jQuery antes de tu script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function cambiarEstado(id) {
            $.ajax({
                url: "{{ route('prestamo-pagarCuota', ':id') }}".replace(':id', id),
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    let button = $("button[onclick='cambiarEstado(" + id + ")']");
                    button.text(response.mensaje); 
                    button.removeClass('bg-green-500 bg-yellow-500');
                    button.addClass(response.estado == 1 ? 'bg-green-500' : 'bg-yellow-500');
                    $('#total-pagado').text(response.totalPagado); 
                },
                error: function() {
                    alert('Ocurrió un error al cambiar el estado');
                }
            });
        }
  
</script>
