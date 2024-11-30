<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro de Socio</title>
    <style>
        @page {
            margin: 1.5cm;
            /* Márgenes ajustados */
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
        }

        .header {
            text-align: center;
            margin-bottom: -30px;

        }

        .header h1 {
            color: #FF6B00;
            font-size: 14px;

        }

        .photo-box {
            border: 1px solid #000;
            width: 3cm;
            height: 4cm;
            text-align: center;
            line-height: 4cm;
            float: right;
            /* Alineación a la izquierda */
            margin-right: 10px;
            margin-bottom:50px;
            margin-top: -75px;
            /* Espacio a la derecha de la foto */
        }

        .socio-info {
            float: left;
            /* Alineación a la izquierda */
            margin-top: 30px;
            margin-left: 280px;
            /* Espacio en la parte superior */
        }

        .section-title {
            clear: both;
            /* Para que la sección siguiente comience debajo de la foto e información */
            background-color: #FF8533;
            color: black;
            padding: 5px;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            /* Espaciado reducido entre tablas */
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
            /* Reducción del padding */
            text-align: left;
        }

        .signatures {
            display: flex;
            /* Usa Flexbox para alinear los elementos */
            justify-content: space-between;
            /* Distribuye los elementos a los extremos */
            margin-top: 50px;
            /* Espacio encima de las firmas */
        }

        .signature-line {
            width: 45%;
            /* Asigna un 45% de ancho para cada firma */
            text-align: center;
            /* Centra el texto dentro del div */
            border-top: 1px solid black;
            /* Línea de firma */
            padding-top: 5px;
            /* Espacio entre la línea y el texto */
        }


        .signature-line p {
            margin: 0;
            padding-top: 5px;
        }

        .signature-line hr {
            border-top: 1px solid black;
            margin: 0;
            width: 80%;
            /* Ajustar el ancho de la línea de firma */
        }

        .clear {
            clear: both;
            /* Para limpiar floats */
        }

        /* Para la firma de la izquierda */
        .signature-line-left {
            float: left;
            /* Coloca el div a la izquierda */
            width: 45%;
            /* Ancho de la firma */
            text-align: center;
            /* Centra el texto dentro del div */
            border-top: 1px solid black;
            /* Línea de la firma */
            padding-top: 5px;
            /* Espacio entre la línea y el texto */
            margin-top: 30px;
            /* Espacio encima de la firma */
        }

        /* Para la firma de la derecha */
        .signature-line-right {
            float: right;
            /* Coloca el div a la derecha */
            width: 45%;
            /* Asigna el 45% del ancho de la página */
            text-align: center;
            /* Centra el texto dentro del div */
            border-top: 1px solid black;
            /* Línea de la firma */
            padding-top: 5px;
            /* Espacio entre la línea y el texto */
            margin-top: 30px;
            /* Espacio encima de la firma */
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>COORAC.LT</h1>
        <h1>COOPERATIVA DE AHORRO Y CRÉDITO LA TROYCA Ltda.</h1>
        <p>Av. Bolognesi N° 838 - Huancayo</p>
        <h2>REGISTRO DE SOCIOS</h2>
    </div>

    <div class="photo-box">
        FOTO
    </div>

    <div class="socio-info">
        <p><strong>N° DE SOCIO:</strong> {{ $registro->numero_socio }}</p>
    </div>

    <div class="clear"></div> <!-- Asegura que el contenido siguiente no se superponga -->

    <p style="text-align: justify; margin: 5px 0; font-size:12px">
        Señor Presidente del Consejo de Administración de la Cooperativa de Ahorro y Crédito LA TROYCA Ltda. Solicito
        ser
        aceptado(a) como socio de la cooperativa que usted dirige, declarando aceptar y cumplir las disposiciones de su
        estatuto,
        reglamento interno y disposiciones legales vigentes del mismo. Autorizo a la Cooperativa gestionar mis aportes.
    </p>

    <div class="section-title">DATOS PERSONALES</div>
    <table>
        <tr>
            <td width="50%"><strong>APELLIDO PATERNO:</strong> {{ $registro->datosPersonales->apellido_paterno }}</td>
            <td><strong>APELLIDO MATERNO:</strong> {{ $registro->datosPersonales->apellido_materno }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>NOMBRES:</strong> {{ $registro->datosPersonales->nombres }}</td>
        </tr>
        <tr>
            <td><strong>DNI N°:</strong> {{ $registro->datosPersonales->dni }}</td>
            <td><strong>FECHA DE NACIMIENTO:</strong>
                {{ $registro->datosPersonales->fecha_nacimiento->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>ESTADO CIVIL:</strong> {{ $registro->datosPersonales->estado_civil }}</td>
            <td><strong>PROFESIÓN U OCUPACIÓN:</strong> {{ $registro->datosPersonales->profesion_ocupacion }}</td>
        </tr>
        <tr>
            <td><strong>NACIONALIDAD:</strong> {{ $registro->datosPersonales->nacionalidad }}</td>
            <td><strong>SEXO:</strong> {{ $registro->datosPersonales->sexo }}</td>
        </tr>
    </table>

    <div class="section-title">DIRECCIÓN DOMICILIARIA</div>
    <table>
        <tr>
            <td><strong>DEPARTAMENTO:</strong> {{ $registro->direccion->departamento }}</td>
            <td><strong>PROVINCIA:</strong> {{ $registro->direccion->provincia }}</td>
        </tr>
        <tr>
            <td><strong>DISTRITO:</strong> {{ $registro->direccion->distrito }}</td>
            <td><strong>TIPO VIVIENDA:</strong> {{ $registro->direccion->tipo_vivienda }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>DIRECCIÓN:</strong> {{ $registro->direccion->direccion }}</td>
        </tr>
        <tr>
            <td><strong>REFERENCIA:</strong> {{ $registro->direccion->referencia }}</td>
            <td><strong>TELÉFONO:</strong> {{ $registro->direccion->telefono }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>CORREO:</strong> {{ $registro->direccion->correo }}</td>
        </tr>
    </table>

    <div class="section-title">INFORMACIÓN LABORAL</div>
    <table>
        <tr>
            <td colspan="2"><strong>SITUACIÓN:</strong> {{ $registro->informacionLaboral->situacion }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>INSTITUCIÓN/EMPRESA:</strong>
                {{ $registro->informacionLaboral->institucion_empresa }}</td>
        </tr>
        <tr>
            <td><strong>DIRECCIÓN LABORAL:</strong> {{ $registro->informacionLaboral->direccion_laboral }}</td>
            <td><strong>TELÉFONO:</strong> {{ $registro->informacionLaboral->telefono_laboral }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>CARGO:</strong> {{ $registro->informacionLaboral->cargo }}</td>
        </tr>
    </table>

    @if($registro->conyuge)
        <div class="section-title">DATOS DEL CÓNYUGE</div>
        <table>
            <tr>
                <td colspan="2"><strong>APELLIDOS Y NOMBRES:</strong> {{ $registro->conyuge->apellidos_nombres }}</td>
            </tr>
            <tr>
                <td><strong>DNI N°:</strong> {{ $registro->conyuge->dni }}</td>
                <td><strong>FECHA NAC.:</strong> {{ $registro->conyuge->fecha_nacimiento->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>OCUPACIÓN:</strong> {{ $registro->conyuge->ocupacion }}</td>
                <td><strong>CELULAR:</strong> {{ $registro->conyuge->celular }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>DIRECCIÓN:</strong> {{ $registro->conyuge->direccion }}</td>
            </tr>
        </table>
    @endif

    @if($registro->beneficiarios->count() > 0)
        <div class="section-title">BENEFICIARIOS</div>
        @foreach($registro->beneficiarios as $beneficiario)
            <table>
                <tr>
                    <td colspan="2"><strong>APELLIDOS Y NOMBRES:</strong> {{ $beneficiario->apellidos_nombres }}</td>
                </tr>
                <tr>
                    <td><strong>DNI N°:</strong> {{ $beneficiario->dni }}</td>
                    <td><strong>FECHA NAC.:</strong> {{ $beneficiario->fecha_nacimiento->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td><strong>PARENTESCO:</strong> {{ $beneficiario->parentesco }}</td>
                    <td><strong>SEXO:</strong> {{ $beneficiario->sexo }}</td>
                </tr>
            </table>
        @endforeach
    @endif

    <div class="signatures" style="margin-top: 50px;">
        <div class="signature-line-left">SOCIO</div>
        <div class="signature-line-right">JEFE DE OPERACIONES</div>
    </div>



</body>

</html>
