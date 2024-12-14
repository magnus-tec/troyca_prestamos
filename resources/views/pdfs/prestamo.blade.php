 <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            font-size: 12px;
        }
        .header {
            margin-bottom: 20px;
        }
        .content {
            margin-top: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
         .status {
            padding: 3px 6px;
            border-radius: 5px;
        }
        .status.pending {
            background-color: #ffeb3b;
            color: #000;
        }
        .status.paid {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Detalles del Préstamo</h1>
        <p>Prestamo ID: {{ $prestamo->id }}</p>
        <p>Cliente: {{ $prestamo->registroSocio->datosPersonales->nombres }} {{ $prestamo->registroSocio->datosPersonales->apellido_paterno }} {{ $prestamo->registroSocio->datosPersonales->apellido_materno }}</p>
         <p>DNI: {{ $prestamo->registroSocio->datosPersonales->dni }}</p>
        <p>Asesor: {{ $prestamo->asesor }}</p>
        <p>Codigo Socio: {{ $prestamo->registroSocio->numero_socio }}</p>
        <p>Estado: {{ $prestamo->estado == 0 ? 'Activo' : 'Finalizado' }}</p> 
    </div>

    <div class="content">
        <h3>Detalles del Préstamo</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha de Solicitud</th>
                    <th>Fecha de Desembolso</th>
                    <th>Monto</th>
                    <th>Cuotas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $prestamo->fecha_solicitud }}</td>
                    <td>{{ $prestamo->fecha_desembolso }}</td>
                    <td>{{ $detalles->monto }}</td>
                    <td>{{ $detalles->cantidad_cuotas }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Detalles de las Cuotas</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Cuota</th>
                    <th>Fecha de Pago</th>
                    <th>Saldo Capital</th>
                    <th>Amortizacion</th>
                    <th>Interes</th>
                    <th>Cuota</th>
                    <th>Mora</th>
                    <th>Subtotal</th>
                    <th>Monto Pagado</th>
                    <th>Estado</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 1;
                ?>
                @foreach($prestamoCuotas as $cuota)
                    <tr>
                        <td>Cuota {{$contador++}}</td>
                        <td>{{ $cuota->fecha_pago }}</td>
                        <td>{{ $cuota->saldo_capital }}</td>
                        <td> - </td>
                        <td> - </td>
                        <td> {{$cuota->cuota}} </td>
                        <td> - </td>
                        <td> {{$cuota->subtotal}} </td>
                        <td> - </td>
                        <td>
                            <span class="status {{ $cuota->estado == 0 ? 'pending' : 'paid' }}">
                                {{ $cuota->estado == 0 ? 'Pendiente' : 'Pagada' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
