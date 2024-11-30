<?php

namespace App\Http\Controllers;

use App\Models\RegistroSocio;
use App\Models\DatosPersonales;
use App\Models\Direccion;
use App\Models\InformacionLaboral;
use App\Models\Conyuge;
use App\Models\Beneficiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistroSocioController extends Controller
{
    public function index()
    {
        $registros = RegistroSocio::with('datosPersonales')->get();
        return view('registrar-socios', compact('registros'));
    }

    public function create(Request $request)
    {
        $activeTab = $request->segment(2) ?? 'datos-personales';
        return view('nuevo-registro', compact('activeTab'));
    }

    public function storeDatosPersonales(Request $request)
    {
        $request->validate([
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'dni' => 'required|unique:datos_personales,dni',
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'required',
            'profesion_ocupacion' => 'nullable|string',
            'nacionalidad' => 'required',
            'sexo' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $registro = RegistroSocio::create([
                'numero_socio' => $this->generarNumeroSocio(),
                'estado' => 'activo',
            ]);

            $registro->datosPersonales()->create($request->all());
        });

        return redirect()->route('registro.direccion');
    }

    public function storeDireccion(Request $request)
    {
        $request->validate([
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'tipo_vivienda' => 'required|in:propia,alquilada,familiar,otro',
            'direccion' => 'required',
            'referencia' => 'nullable',
            'telefono' => 'nullable',
            'correo' => 'nullable|email',
        ]);

        $registro = RegistroSocio::latest()->first();

        if (!$registro) {
            // If no RegistroSocio is found, redirect back with an error message
            return redirect()->route('registro.datos-personales')->with('error', 'Por favor, complete los datos personales primero.');
        }

        try {
            DB::transaction(function () use ($request, $registro) {
                $registro->direccion()->create($request->all());
            });

            return redirect()->route('registro.laboral');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error al guardar la dirección: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Hubo un problema al guardar la dirección. Por favor, inténtelo de nuevo.');
        }
    }

    public function storeLaboral(Request $request)
    {
        $request->validate([
            'situacion_laboral' => 'required',
            'empresa' => 'required',
            'direccion_laboral' => 'required',
            'telefono_laboral' => 'required',
            'cargo' => 'required',
        ]);

        $registro = RegistroSocio::latest()->first();
        $registro->informacionLaboral()->create($request->all());

        return redirect()->route('registro.conyuge');
    }

    public function storeConyuge(Request $request)
    {
        $request->validate([
            'apellidos_nombres' => 'required',
            'dni' => 'required|unique:conyuges,dni',
            'fecha_nacimiento' => 'required|date',
            'celular' => 'nullable',
            'ocupacion' => 'required',
            'direccion' => 'required',
        ]);

        $registro = RegistroSocio::latest()->first();

        if (!$registro) {
            return redirect()->route('registro.datos-personales')->with('error', 'Por favor, complete los datos personales primero.');
        }

        try {
            DB::transaction(function () use ($request, $registro) {
                $registro->conyuge()->create($request->all());
            });

            return redirect()->route('registro.beneficiarios')->with('success', 'Datos del cónyuge guardados exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error al guardar los datos del cónyuge: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al guardar los datos del cónyuge. Por favor, inténtelo de nuevo.');
        }
    }

    public function storeBeneficiarios(Request $request)
    {
        $request->validate([
            'beneficiarios.*.apellidos_nombres' => 'required',
            'beneficiarios.*.dni' => 'required|digits:8',
            'beneficiarios.*.fecha_nacimiento' => 'required|date',
            'beneficiarios.*.parentesco' => 'required',
            'beneficiarios.*.sexo' => 'required|in:masculino,femenino',
        ]);

        $registro = RegistroSocio::latest()->first();

        if (!$registro) {
            return redirect()->route('registro.datos-personales')->with('error', 'Por favor, complete los datos personales primero.');
        }

        try {
            DB::transaction(function () use ($request, $registro) {
                foreach ($request->beneficiarios as $beneficiario) {
                    $registro->beneficiarios()->create($beneficiario);
                }
            });

            return redirect()->route('registrar-socios')->with('success', 'Beneficiarios registrados exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error al guardar los beneficiarios: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al guardar los beneficiarios. Por favor, inténtelo de nuevo.');
        }
    }

    public function edit(RegistroSocio $registro)
    {
        return view('editar-registro', compact('registro'));
    }

    public function update(Request $request, RegistroSocio $registro)
    {
        $request->validate([
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
            'dni' => 'required|unique:datos_personales,dni,' . $registro->datosPersonales->id,
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'required',
            'profesion' => 'required',
            'nacionalidad' => 'required',
            'sexo' => 'required',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'tipo_vivienda' => 'required',
            'direccion' => 'required',
            'situacion_laboral' => 'required',
            'empresa' => 'required',
            'direccion_laboral' => 'required',
            'telefono_laboral' => 'required',
            'cargo' => 'required',
        ]);

        DB::transaction(function () use ($request, $registro) {
            $registro->datosPersonales()->update([
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'nombres' => $request->nombres,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'estado_civil' => $request->estado_civil,
                'profesion_ocupacion' => $request->profesion,
                'nacionalidad' => $request->nacionalidad,
                'sexo' => $request->sexo,
            ]);

            $registro->direccion()->update([
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'distrito' => $request->distrito,
                'tipo_vivienda' => $request->tipo_vivienda,
                'direccion' => $request->direccion,
                'referencia' => $request->referencia,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
            ]);

            $registro->informacionLaboral()->update([
                'situacion' => $request->situacion_laboral,
                'institucion_empresa' => $request->empresa,
                'direccion_laboral' => $request->direccion_laboral,
                'telefono_laboral' => $request->telefono_laboral,
                'cargo' => $request->cargo,
            ]);

            if ($request->has('nombre_conyuge')) {
                $registro->conyuge()->updateOrCreate(
                    ['registro_socio_id' => $registro->id],
                    [
                        'apellidos_nombres' => $request->nombre_conyuge,
                        'dni' => $request->dni_conyuge,
                        'fecha_nacimiento' => $request->fecha_nacimiento_conyuge,
                        'celular' => $request->celular_conyuge,
                        'ocupacion' => $request->ocupacion_conyuge,
                        'direccion' => $request->direccion_conyuge,
                    ]
                );
            }

            if ($request->has('beneficiarios')) {
                $registro->beneficiarios()->delete();
                foreach ($request->beneficiarios as $beneficiario) {
                    $registro->beneficiarios()->create([
                        'apellidos_nombres' => $beneficiario['nombre'],
                        'dni' => $beneficiario['dni'],
                        'fecha_nacimiento' => $beneficiario['fecha_nacimiento'],
                        'parentesco' => $beneficiario['parentesco'],
                        'sexo' => $beneficiario['sexo'],
                    ]);
                }
            }
        });

        return redirect()->route('registrar-socios')->with('success', 'Registro de socio actualizado con éxito.');
    }

    public function destroy(RegistroSocio $registro)
    {
        $registro->delete();
        return redirect()->route('registrar-socios')->with('success', 'Registro de socio eliminado con éxito.');
    }

    public function generarPDF(RegistroSocio $registro)
{
    $pdf = PDF::loadView('pdfs.registro_socio', compact('registro'));
    return $pdf->download('registro_socio_' . $registro->numero_socio . '.pdf');
}

    private function generarNumeroSocio()
    {
        $ultimoRegistro = RegistroSocio::latest()->first();
        $ultimoNumero = $ultimoRegistro ? intval(substr($ultimoRegistro->numero_socio, 3)) : 0;
        $nuevoNumero = $ultimoNumero + 1;
        return 'SOC' . str_pad($nuevoNumero, 6, '0', STR_PAD_LEFT);
    }
}

