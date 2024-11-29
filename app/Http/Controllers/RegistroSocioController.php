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
        try {
            $registros = RegistroSocio::with(['datosPersonales'])
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('registrar-socios', ['registros' => $registros]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar los registros: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('nuevo-registro', ['activeTab' => 'datos-personales']);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Crear registro de socio
            $registroSocio = RegistroSocio::create([
                'numero_socio' => RegistroSocio::generarNumeroSocio(),
                'estado' => 'activo'
            ]);

            // Guardar datos personales
            $datosPersonales = $registroSocio->datosPersonales()->create([
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'nombres' => $request->nombres,
                'dni' => $request->dni,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'estado_civil' => $request->estado_civil,
                'profesion_ocupacion' => $request->profesion_ocupacion,
                'nacionalidad' => $request->nacionalidad,
                'sexo' => $request->sexo
            ]);

            DB::commit();

            return redirect()->route('registro.direccion')
                ->with('success', 'Datos personales guardados correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }
    }
    public function storeDatosPersonales(Request $request)
{
    try {
        DB::beginTransaction();

        // Crear registro de socio
        $registroSocio = RegistroSocio::create([
            'numero_socio' => RegistroSocio::generarNumeroSocio(),
            'estado' => 'activo'
        ]);

        // Guardar datos personales
        $datosPersonales = $registroSocio->datosPersonales()->create([
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombres' => $request->nombres,
            'dni' => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'estado_civil' => $request->estado_civil,
            'profesion_ocupacion' => $request->profesion_ocupacion,
            'nacionalidad' => $request->nacionalidad,
            'sexo' => $request->sexo
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Datos personales guardados correctamente',
            'data' => $registroSocio->load('datosPersonales'),
            'redirect' => route('registro.direccion')
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar los datos: ' . $e->getMessage()
        ], 500);
    }
}

    public function storeDireccion(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $registroSocio = RegistroSocio::findOrFail($id);

            // Guardar dirección
            $registroSocio->direccion()->create([
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'distrito' => $request->distrito,
                'tipo_vivienda' => $request->tipo_vivienda,
                'direccion' => $request->direccion,
                'referencia' => $request->referencia,
                'telefono' => $request->telefono,
                'correo' => $request->correo
            ]);

            DB::commit();

            return redirect()->route('registro.laboral')
                ->with('success', 'Dirección guardada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar la dirección: ' . $e->getMessage());
        }
    }

    public function storeLaboral(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $registroSocio = RegistroSocio::findOrFail($id);

            // Guardar información laboral
            $registroSocio->informacionLaboral()->create([
                'situacion' => $request->situacion,
                'institucion_empresa' => $request->institucion_empresa,
                'direccion_laboral' => $request->direccion_laboral,
                'telefono_laboral' => $request->telefono_laboral,
                'cargo' => $request->cargo
            ]);

            DB::commit();

            return redirect()->route('registro.conyuge')
                ->with('success', 'Información laboral guardada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar la información laboral: ' . $e->getMessage());
        }
    }

    public function storeConyuge(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $registroSocio = RegistroSocio::findOrFail($id);

            // Guardar datos del cónyuge
            if ($request->has('tiene_conyuge')) {
                $registroSocio->conyuge()->create([
                    'apellidos_nombres' => $request->apellidos_nombres,
                    'dni' => $request->dni,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'celular' => $request->celular,
                    'ocupacion' => $request->ocupacion,
                    'direccion' => $request->direccion
                ]);
            }

            DB::commit();

            return redirect()->route('registro.beneficiarios')
                ->with('success', 'Datos del cónyuge guardados correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar los datos del cónyuge: ' . $e->getMessage());
        }
    }

    public function storeBeneficiarios(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $registroSocio = RegistroSocio::findOrFail($id);

            // Guardar beneficiarios
            foreach ($request->beneficiarios as $beneficiario) {
                $registroSocio->beneficiarios()->create([
                    'apellidos_nombres' => $beneficiario['apellidos_nombres'],
                    'dni' => $beneficiario['dni'],
                    'fecha_nacimiento' => $beneficiario['fecha_nacimiento'],
                    'parentesco' => $beneficiario['parentesco'],
                    'sexo' => $beneficiario['sexo']
                ]);
            }

            DB::commit();

            return redirect()->route('registrar-socios')
                ->with('success', 'Registro completado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar los beneficiarios: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $registro = RegistroSocio::with([
            'datosPersonales',
            'direccion',
            'informacionLaboral',
            'conyuge',
            'beneficiarios'
        ])->findOrFail($id);

        return view('editar-registro', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $registro = RegistroSocio::findOrFail($id);
            
            // Actualizar datos personales
            if ($registro->datosPersonales) {
                $registro->datosPersonales->update([
                    'apellido_paterno' => $request->apellido_paterno,
                    'apellido_materno' => $request->apellido_materno,
                    'nombres' => $request->nombres,
                    'dni' => $request->dni,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'estado_civil' => $request->estado_civil,
                    'profesion_ocupacion' => $request->profesion_ocupacion,
                    'nacionalidad' => $request->nacionalidad,
                    'sexo' => $request->sexo
                ]);
            }

            // Actualizar dirección
            if ($registro->direccion) {
                $registro->direccion->update($request->only([
                    'departamento', 'provincia', 'distrito', 'tipo_vivienda',
                    'direccion', 'referencia', 'telefono', 'correo'
                ]));
            }

            // Actualizar información laboral
            if ($registro->informacionLaboral) {
                $registro->informacionLaboral->update($request->only([
                    'situacion', 'institucion_empresa', 'direccion_laboral',
                    'telefono_laboral', 'cargo'
                ]));
            }

            // Actualizar cónyuge
            if ($request->has('tiene_conyuge')) {
                if ($registro->conyuge) {
                    $registro->conyuge->update($request->only([
                        'apellidos_nombres', 'dni', 'fecha_nacimiento',
                        'celular', 'ocupacion', 'direccion'
                    ]));
                }
            } else {
                if ($registro->conyuge) {
                    $registro->conyuge->delete();
                }
            }

            // Actualizar beneficiarios
            if ($request->has('beneficiarios')) {
                // Eliminar beneficiarios existentes
                $registro->beneficiarios()->delete();
                
                // Crear nuevos beneficiarios
                foreach ($request->beneficiarios as $beneficiario) {
                    $registro->beneficiarios()->create([
                        'apellidos_nombres' => $beneficiario['apellidos_nombres'],
                        'dni' => $beneficiario['dni'],
                        'fecha_nacimiento' => $beneficiario['fecha_nacimiento'],
                        'parentesco' => $beneficiario['parentesco'],
                        'sexo' => $beneficiario['sexo']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('registrar-socios')
                ->with('success', 'Registro actualizado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar los datos: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $registro = RegistroSocio::findOrFail($id);
            $registro->delete();

            return redirect()->route('registrar-socios')
                ->with('success', 'Registro eliminado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el registro: ' . $e->getMessage());
        }
    }

    public function generarPDF($id)
    {
        $registro = RegistroSocio::with([
            'datosPersonales',
            'direccion',
            'informacionLaboral',
            'conyuge',
            'beneficiarios'
        ])->findOrFail($id);
    
        // En lugar de generar un PDF, mostraremos una vista con todos los datos
        return view('pdfs.registro_socio', compact('registro'));
    }
}