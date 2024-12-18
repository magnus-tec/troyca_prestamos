<?php

namespace App\Http\Controllers;

use App\Models\AporteAhorro;
use App\Models\DetalleAporte;
use App\Models\RegistroSocio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AporteAhorrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aportes = AporteAhorro::where('estado', 0)->with('registroSocio.datosPersonales')->get();
        return view('aporte-ahorros.index', compact('aportes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $socios = RegistroSocio::where('registro_socios.estado', 'activo')
            ->join('datos_personales', 'registro_socios.id', '=', 'datos_personales.registro_socio_id')
            ->select(
                'registro_socios.id',
                DB::raw("CONCAT(datos_personales.nombres, ' ', datos_personales.apellido_paterno, ' ', datos_personales.apellido_materno) AS nombre_completo")
            )
            ->get();
        return view('aporte-ahorros.nuevo-aporte', compact('socios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $aporte = AporteAhorro::where('registro_socio_id', $request->clientes)->first();
            if ($aporte) {
                $nuevoTotal = $aporte->total_aportes + $request->monto;
                $aporte->update(['total_aportes' => $nuevoTotal]);
            } else {
                $aporte = new AporteAhorro();
                $aporte->registro_socio_id = $request->clientes;
                $aporte->estado = 0;
                $aporte->total_aportes = $request->monto;
                $aporte->save();
            }
            $aporteDetalle = new DetalleAporte();
            $aporteDetalle->aporte_id = $aporte->id;
            $aporteDetalle->monto = $request->monto;
            $aporteDetalle->estado = 0;
            $aporteDetalle->save();

            return response()->json([
                'success' => true,
                'message' => 'Aporte guardado con éxito',
                'nuevoTotal' => $aporte->total_aportes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
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
    public function totalAportes($id)
    {
        $total = AporteAhorro::where('registro_socio_id', $id)->value('total_aportes');
        $totalAporte = $total == null ? $total = 0 : $total;
        return response()->json([
            'total' => $totalAporte
        ]);
    }
    public function generarPDF($id)
    {
        $aporte = AporteAhorro::with('registroSocio.datosPersonales')->find($id);
        $aporteDetalles = DetalleAporte::where('aporte_id', $id)->get();
        $pdf = Pdf::loadView('pdfs.aporte-ahorros', compact('aporte', 'aporteDetalles'));
        return $pdf->stream('aporte-ahorros_' . $aporte->id . '.pdf');
    }
}
