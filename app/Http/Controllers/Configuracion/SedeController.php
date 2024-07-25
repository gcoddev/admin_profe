<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProgramaSedeTurno;
use App\Models\ProgramaTurno;
use App\Models\Programa;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class SedeController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('configuracion_programa.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }

        $sedeturnos = DB::table('programa_sede_turno')
        ->join('programa', 'programa_sede_turno.pro_id', '=', 'programa.pro_id')
        ->join('sede', 'programa_sede_turno.sede_id', '=', 'sede.sede_id')
        ->select('programa_sede_turno.*', 'programa.pro_nombre',
                    'sede.sede_nombre');
        $sedesIds=NULL;
        $proIds=NULL;
        // Verificar si hay filtro por sede_ids
        if (!is_null($this->user->sede_ids)) {
            $sedesIds = json_decode($this->user->sede_ids);

            if (!empty($sedesIds)) { // Verifica si $sedesIds no está vacío
                $sedeturnos->whereIn('sede.sede_id', $sedesIds);
            }
        }
        // Verificar si hay filtro por pro_ids
        if (!is_null($this->user->pro_ids)) {
            $proIds = json_decode($this->user->pro_ids);
            if (!empty($proIds)) { // Verifica si $sedesIds no está vacío
                $sedeturnos->whereIn('programa.pro_id', $proIds);
            }
        }

        // Obtener los resultados
        $sedeturnos = $sedeturnos->get();
        $turnos = ProgramaTurno::all();
        return view('backend.pages.configuracion.sede.index', compact(['turnos','sedeturnos']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
        $sedesIds = json_decode($this->user->sede_ids);
        $proIds = json_decode($this->user->pro_ids);
        // Obtener todas las combinaciones de sede_id y pro_id existentes
        $existingCombinations = DB::table('programa_sede_turno')
        ->select('sede_id', 'pro_id')
        ->get()
        ->map(function($item) {
            return ['sede_id' => $item->sede_id, 'pro_id' => $item->pro_id];
        })->toArray();

        // Obtener programas y sedes originales
        $programasOriginal = Programa::when(!is_null($this->user->pro_ids), function ($query) use ($proIds) {
            if (!empty($proIds)) { // Verifica si $proIds no está vacío
                return $query->whereIn('pro_id', $proIds);
            } else {
                return $query; // Devuelve el query sin modificar si $proIds está vacío
            }
        })->get();
        
        $sedesOriginal = Sede::when(!is_null($this->user->sede_ids), function ($query) use ($sedesIds) {
            if (!empty($sedesIds)) { // Verifica si $sedesIds no está vacío
                return $query->whereIn('sede_id', $sedesIds);
            } else {
                return $query; // Devuelve el query sin modificar si $sedesIds está vacío
            }
        })->get();

        // Filtrar los programas y sedes para mostrar solo los que aún pueden formar nuevas combinaciones válidas
        $programas = $programasOriginal->filter(function($programa) use ($existingCombinations, $sedesOriginal) {
            foreach ($sedesOriginal as $sede) {
                $combination = ['sede_id' => $sede->sede_id, 'pro_id' => $programa->pro_id];
                if (!in_array($combination, $existingCombinations)) {
                    return true;
                }
            }
            return false;
        });

        $sedes = $sedesOriginal->filter(function($sede) use ($existingCombinations, $programasOriginal) {
            foreach ($programasOriginal as $programa) {
                $combination = ['sede_id' => $sede->sede_id, 'pro_id' => $programa->pro_id];
                if (!in_array($combination, $existingCombinations)) {
                    return true;
                }
            }
            return false;
        });

        $turnos = ProgramaTurno::all();
        return view('backend.pages.configuracion.sede.create', compact('sedes','turnos','programas'));
    }


    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'pro_cupo' => 'required|numeric|min:5|max:1000',
            'pro_cupo_preinscrito' => 'required|numeric|min:5|max:5000',
        ], [
            'pro_cupo.required' => 'El campo cupo es obligatorio.',
            'pro_cupo.numeric' => 'El campo cupo debe ser numérico.',
            'pro_cupo.min' => 'El valor mínimo para el campo cupo es :min.',
            'pro_cupo.max' => 'El valor máximo para el campo cupo es :max.',
            'pro_cupo_preinscrito.required' => 'El campo cupo preinscrito es obligatorio.',
            'pro_cupo_preinscrito.numeric' => 'El campo cupo preinscrito debe ser numérico.',
            'pro_cupo_preinscrito.min' => 'El valor mínimo para el campo cupo preinscrito es :min.',
            'pro_cupo_preinscrito.max' => 'El valor máximo para el campo cupo preinscrito es :max.',
        ]);
        $sedeturno = new ProgramaSedeTurno();
        $sedeturno->pro_tur_ids = json_encode($request->turnos);
        $sedeturno->pro_cupo = $request->pro_cupo;
        $sedeturno->pro_cupo_preinscrito = $request->pro_cupo_preinscrito;
        $sedeturno->sede_id = $request->sede_id;
        $sedeturno->pro_id = $request->pro_id;
        $sedeturno->save();
        session()->flash('success', 'Sede Turno creada con exito');
        return redirect()->route('configuracion.sede.index');
    }
    public function update(Request $request, $pv_id)
    {
        $validator = Validator::make($request->all(), [
            'pv_nombre' => 'required|max:100',
            'pv_numero' => 'required|numeric|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $sedesIds = json_decode($this->user->sede_ids);
        $proIds = json_decode($this->user->pro_ids);
        // Obtener todas las combinaciones de sede_id y pro_id existentes
        $existingCombinations = DB::table('programa_sede_turno')
        ->select('sede_id', 'pro_id')
        ->get()
        ->map(function($item) {
            return ['sede_id' => $item->sede_id, 'pro_id' => $item->pro_id];
        })->toArray();

        // Obtener programas y sedes originales
        $programasOriginal = Programa::when(!is_null($this->user->pro_ids), function ($query) use ($proIds) {
                return $query->whereIn('pro_id', $proIds);
            })->get();

        $sedesOriginal = Sede::when(!is_null($this->user->sede_ids), function ($query) use ($sedesIds) {
                return $query->whereIn('sede_id', $query);
            })->get();

        // Filtrar los programas y sedes para mostrar solo los que aún pueden formar nuevas combinaciones válidas
        $programas = $programasOriginal->filter(function($programa) use ($existingCombinations, $sedesOriginal) {
            foreach ($sedesOriginal as $sede) {
                $combination = ['sede_id' => $sede->sede_id, 'pro_id' => $programa->pro_id];
                if (!in_array($combination, $existingCombinations)) {
                    return true;
                }
            }
            return false;
        });

        $sedes = $sedesOriginal->filter(function($sede) use ($existingCombinations, $programasOriginal) {
            foreach ($programasOriginal as $programa) {
                $combination = ['sede_id' => $sede->sede_id, 'pro_id' => $programa->pro_id];
                if (!in_array($combination, $existingCombinations)) {
                    return true;
                }
            }
            return false;
        });

        $turnos = ProgramaTurno::all();
        $version = ProgramaVersion::findOrFail($pv_id);
        $version->pv_nombre = $request->pv_nombre;
        $version->pv_numero = $request->pv_numero;
        $version->save();

        return response()->json(['success' => 'Versión actualizada con éxito', 'version' => $version]);
    }

    public function destroy($id)
    {
        $version = ProgramaVersion::findOrFail($id);
        $version->delete();

        return response()->json(['success' => 'Versión eliminada con éxito']);
    }
    public function storeTipo(Request $request)
    {
        // Validation Data
        $request->validate([
            'pro_tip_nombre' => 'required|max:200',
        ]);
        $tipo = new ProgramaTipo();
        $tipo->pro_tip_nombre = $request->pro_tip_nombre;
        $tipo->save();
        session()->flash('success', 'Tipo creada con exito');
        return redirect()->route('configuracion.sede.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }



}
