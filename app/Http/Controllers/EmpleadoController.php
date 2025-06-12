<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\Local;
use App\Models\TipoContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $empleados = Empleado::all(); // Aquí puedes obtener los empleados de la base de datos

        return view('empleado.index', compact('empleados'));
    }
    public function create()
    {
        $locales = Local::all();
        $tiposContrato = TipoContrato::all();
        return view('empleado.create', compact('locales', 'tiposContrato'));
    }
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'nombre' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
        //     'apellido' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
        //     'dni' => ['required', 'regex:/^[0-9]{8}$/', 'unique:empleados,dni'],
        //     'email' => 'required|email|max:100|unique:empleados,email',
        //     'fecha_nacimiento' => [
        //         'required',
        //         'date',
        //         'before:today',
        //         'before:' . now()->subYears(18)->format('Y-m-d'),
        //     ],
        // ],
        // [
        //     'nombre.required' => 'El nombre es obligatorio.',
        //     'apellido.required' => 'El apellido es obligatorio.',
        //     'dni.required' => 'El DNI es obligatorio.',
        //     'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser una fecha futura.',
        //     'email.required' => 'El correo electrónico es obligatorio.',
        //     'fecha_nacimiento.before' => 'Debe ser mayor de 18 años.',
        //     'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        //     'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
        //     'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',
        //     'dni.string' => 'El DNI debe ser una cadena de texto.',
        //     'email.email' => 'El formato del correo electrónico es inválido.',
        //     'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        //     'dni.unique' => 'El DNI ya está registrado.',
        //     'email.unique' => 'El correo electrónico ya está registrado.',
        // ]);
        $data = $request->only(['nombre', 'apellido', 'dni', 'email', 'fecha_nacimiento']);
        try{
            DB::beginTransaction();
            $empleado = Empleado::create($data);
            Log::info('Empleado creado: ' . $empleado->id, $data);
               Log::info('Contrato creado para empleado: ' . $empleado->id, [
                'tipo_contrato_id' => $request->tipo_contrato_id,
                'cargo_id' => $request->cargo_id,
                'area_id' => $request->area_id,
                'local_id' => $request->local_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);
            Contrato::create([
                'id_empleado' => $empleado->id,
                'id_tipo_contrato' => $request->tipo_contrato_id,
                'id_cargo' => $request->cargo_id,
                'id_area' => $request->area_id,
                'id_local' => $request->local_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);
            DB::commit();
            return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente.');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al crear el empleado: ' . $e->getMessage()]);
        }
        return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente.');
    }
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }
    public function update(Request $request, $id)
    {

        $empleado = Empleado::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:empleados,dni,' . $empleado->id,
            'email' => 'required|email|max:255|unique:empleados,email,' . $empleado->id,
            'fecha_nacimiento' => 'required|date',
        ]);

        $empleado->update($data);

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
    }
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleado.show', compact('empleado'));
    }


}
