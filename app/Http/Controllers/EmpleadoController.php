<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cargo;
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
        $query = Empleado::query();

        // Filtros por datos personales
        // if ($request->filled('buscar')) {
        //     $buscar = $request->input('buscar');
        //     $query->where(function($q) use ($buscar) {
        //         $q->where('nombre', 'like', "%$buscar%")
        //         ->orWhere('apellido', 'like', "%$buscar%")
        //         ->orWhere('dni', 'like', "%$buscar%")
        //         ->orWhere('email', 'like', "%$buscar%");
        //     });
        // }

        // Filtros por datos empresariales
        // 1. Filtro por el area
        if ($request->filled('area_id')) {
            $query->whereHas('contratos', function ($q) use ($request) {
                $q->where('id_area', $request->area_id);
            });
        }

        // 2. Filtro por cargo
        if ($request->filled('cargo_id')) {
            $query->whereHas('contratos', function($q) use ($request) {
                $q->where('id_cargo', $request->cargo_id);
            });
        }

        // 3. Filtro por local
        if ($request->filled('local_id')) {
            $query->whereHas('contratos', function($q) use ($request) {
                $q->where('id_local', $request->local_id);
            });
        }

        // 4. Filtro por rango de fecha de contratación
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereHas('contratos', function($q) use ($request) {
                $q->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin]);
            });
        }

        $empleados = $query->paginate(5)->appends($request->all());
        // Obtener los datos necesarios para los filtros
        $locales = Local::all();
        $areas = Area::all();
        $cargos = Cargo::all();
        $tiposContrato = TipoContrato::all();
        return view('empleado.index', compact('empleados', 'locales', 'areas', 'cargos', 'tiposContrato'));
    }

    public function create()
    {
        $locales = Local::all();
        $tiposContrato = TipoContrato::all();
        return view('empleado.create', compact('locales', 'tiposContrato'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'apellido' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'dni' => ['required', 'regex:/^[0-9]{8}$/', 'unique:empleados,dni'],
            'email' => 'required|email|max:100|unique:empleados,email',
            'fecha_nacimiento' => ['required','date','before:today','before:' . now()->subYears(18)->format('Y-m-d')],
        ],
        [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser una fecha futura.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'fecha_nacimiento.before' => 'Debe ser mayor de 18 años.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'dni.unique' => 'El DNI ya está registrado.',
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]);

        $dataContrato = $request->validate([
            'id_tipo_contrato' => 'required|exists:tipos_contrato,id',
            'id_cargo' => 'required|exists:cargos,id',
            'id_area' => 'required|exists:areas,id',
            'id_local' => 'required|exists:locales,id',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin|before_or_equal:today',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
        ],
        [
            'id_tipo_contrato.required' => 'El tipo de contrato es obligatorio.',
            'id_tipo_contrato.exists' => 'El tipo de contrato seleccionado no es válido.',
            'id_cargo.required' => 'El cargo es obligatorio.',
            'id_cargo.exists' => 'El cargo seleccionado no es válido.',
            'id_area.required' => 'El área es obligatoria.',
            'id_area.exists' => 'El área seleccionada no es válida.',
            'id_local.required' => 'El local es obligatorio.',
            'id_local.exists' => 'El local seleccionado no es válido.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        ]);

        // $data = $request->only(['nombre', 'apellido', 'dni', 'email', 'fecha_nacimiento']);
        try{
            DB::beginTransaction();
            $empleado = Empleado::create($data);
            $dataContrato['id_empleado'] = $empleado->id;
            Log::info('DATOS DE CONTRATO: ', $dataContrato);
            Contrato::create($dataContrato);
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
        $contrato = $empleado->contrato;
        return view('empleado.edit', compact('empleado', 'contrato'));
    }
    public function update(Request $request, $id)
    {

        $empleado = Empleado::findOrFail($id);
        $data = $request->validate([
            'nombre' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'apellido' => 'required|string|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
            'email' => 'required|email|max:100|unique:empleados,email',
            'fecha_nacimiento' => ['required','date','before:today','before:' . now()->subYears(18)->format('Y-m-d')],
        ],
        [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser una fecha futura.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'fecha_nacimiento.before' => 'Debe ser mayor de 18 años.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]);

        $empleado->update($data);

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
    }
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->contratos()->delete();
        $empleado->delete();

        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleado.show', compact('empleado'));
    }
    public function baja($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->estado = 'inactivo';
        $empleado->save();
        return redirect()->route('empleado.index')->with('success', 'Empleado dado de baja correctamente.');
    }
}
