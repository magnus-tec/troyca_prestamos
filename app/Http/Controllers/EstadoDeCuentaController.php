<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Prestamo;
use App\Models\PrestamoCuota;
use App\Models\RegistroSocio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoDeCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::where('estado', 0)->with('datosPersonales')->get();
        return view('estado-cuenta.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $socios = RegistroSocio::where('registro_socios.estado', 'activo')
            ->join('datos_personales', 'registro_socios.id', '=', 'datos_personales.registro_socio_id')
            ->select(
                'registro_socios.id',
                DB::raw("CONCAT(datos_personales.nombres, ' ', datos_personales.apellido_paterno, ' ', datos_personales.apellido_materno) AS nombre_completo")
            )
            ->get();

        return view('estado-cuenta.nuevo-prestamo', compact('socios'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $prestamo = Prestamo::create([
            'fecha_solicitud' => $request->fecha_solicitud,
            'registro_socio_id' => $request->clientes,
            'producto' => $request->producto,
            'garantia' => $request->garantia,
            'detalle_garantia' => $request->detalle_garantia,
            'fecha_desembolso' => $request->fecha_desembolso,
            'dni' => $request->dni,
            'asesor' => $request->asesor,
            'expediente' => $request->expediente,
            'estado' => 0,

        ]);

        $detalle_prestamo = DetallePrestamo::create([
            'prestamos_id' => $prestamo->id,
            'monto' => $request->monto_prestamo,
            'modalidad' => $request->modalidad_pago,
            'tem' => $request->tem,
            'cantidad_cuotas' => $request->cantidad_cuotas,
            'cuota' => $request->cuota,
            'f_primera_cuota' => $request->fecha_p_cuota,
            'ted' => $request->ted,
        ]);
        $listado_pagos = json_decode($request->listado_pagos, true); // true convierte el JSON en un array asociativo

        foreach ($listado_pagos as $pago) {
            PrestamoCuota::create([
                'prestamos_id' => $prestamo->id,
                'fecha_pago' => $pago['fecha'],
                'fecha_vencimiento' => $pago['fechaVencimiento'],
                'cuota' => $pago['monto'],
                'saldo_capital' => $pago['saldoCapital'],
                'subtotal' => $pago['subtotal'],
                'ted' => $pago['interesDiario'],
                'monto_pago' => $pago['montoPagado'],
                'estado' => 0,
            ]);
        }


        // Retornar una respuesta de éxito
        return redirect()->route('estado-de-cuenta')->with('success', 'Préstamo guardado con éxito');
    }
    public function generarPDF($id)
    {
        $prestamo = Prestamo::with('datosPersonales')->find($id);

        $detalles = DetallePrestamo::where('prestamos_id', $id)->first();
        $prestamoCuotas = PrestamoCuota::where('prestamos_id', $id)->get();

        $pdf = Pdf::loadView('pdfs.prestamo', compact('prestamo', 'detalles', 'prestamoCuotas'));

        // return $pdf->download('prestamo_' . $prestamo->id . '.pdf');
        return $pdf->stream('prestamo_' . $prestamo->id . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
