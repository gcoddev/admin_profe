<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Genero;
use App\Models\EventoInscripcion;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamento = Departamento::all();
        $genero = Genero::all();
        return view('frontend.pages.evento.index_1',[
            'departamentos' => $departamento,
            'generos' => $genero
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $departamento = Departamento::all();
        $genero = Genero::all();
        return view('frontend.pages.evento.index_1',[
            'departamentos' => $departamento,
            'generos' => $genero
        ]);
    }
    # PARTICIPANTES

    public function storeParticipante(Request $request)
    {
        $data['inscripcion'] = DB::select('
                SELECT *
                FROM evento_inscripcion
                WHERE
                    eve_ins_carnet_identidad="' . $request['eve_ins_carnet_identidad'] . '" AND
                    eve_id="' . $request['eve_id'] . '"
            ');
        if (count($data['inscripcion']) > 0) {
            $eve_ins_id = $data['inscripcion'][0]->eve_ins_id;
            return redirect()->route('evento.comprobanteParticipante', encrypt($eve_ins_id))->with('danger', 'Usted ya cuenta con un registro, puede volver a descargar su formulario de inscripción.');
        } else {
            // PARA REGISTRO LIBRE
            $inscripcion = new EventoInscripcion();
            // $inscripcion->ei_rda = 0;
            $inscripcion->eve_ins_carnet_identidad = $request['eve_ins_carnet_identidad'];
            $inscripcion->eve_ins_carnet_complemento = $request['eve_ins_carnet_complemento'];
            $inscripcion->eve_ins_nombre_1 = $request['eve_ins_nombre_1'];
            $inscripcion->eve_ins_nombre_2 = $request['eve_ins_nombre_2']??'';
            $inscripcion->eve_ins_apellido_1 = $request['eve_ins_apellido_1'];
            $inscripcion->eve_ins_apellido_2 = $request['eve_ins_apellido_2'];
            // FECHA DE NACIMIENTO
            // $fechaNacimiento = $request['anio'] . '-' . $request['mes'] . '-' . $request['dia'];
            // $fechaNacimiento = $request['ei_fecha_nacimiento'];
            $inscripcion->eve_ins_fecha_nacimiento = $request['eve_ins_fecha_nacimiento'];
            $inscripcion->eve_correo = $request['eve_correo'];
            $inscripcion->eve_celular = $request['eve_celular'];
            $inscripcion->eve_ins_carnet_complemento = $request['eve_ins_carnet_complemento']??'';
            $inscripcion->gen_id = decrypt($request['gen_id']);
            $inscripcion->dep_id = decrypt($request['dep_id']);
            // $inscripcion->eve_id = 25;
            // NIVEL
            // $inscripcion->en_id = decrypt($request['en_id']);
            // $inscripcion->pm_id = decrypt($request['pm_id']);
            // MODALIDAD DE ASISTENCIA
            // $inscripcion->em_id = $request['em_id'];
            $inscripcion->eve_id = $request['eve_id'];

            // AUTORIZACIÓN
            // if ($request['ei_autorizacion']) {
            //     $inscripcion->ei_autorizacion = 1;
            // } else {
            //     $inscripcion->ei_autorizacion = 0;
            // }
            // MODALIDAD DE ASISTENCIA
            // if ($request['pm_id'] == 1) {
                // MODALIDAD PRESENCIAL - DE ACUERDO A LA INSTITUCIÓN
                $inscripcion->pm_id = $request['pm_id'];
            // }
            //

            // dd("siiiiii");
            $inscripcion->save();

            return redirect()->route('evento.comprobanteParticipante', encrypt($inscripcion->eve_ins_id));
        }
        //

    }
    public function storeParticipantes(Request $request)
    {
        $data['inscripcion'] = DB::select('
                SELECT *
                FROM evento_inscripcion
                WHERE
                    eve_ins_carnet_identidad="' . $request['eve_ins_carnet_identidad'] . '" AND
                    eve_id="' . $request['eve_id'] . '"
            ');
        if (count($data['inscripcion']) > 0) {
            $eve_ins_id = $data['inscripcion'][0]->eve_ins_id;
            return redirect()->route('evento.comprobanteParticipante', encrypt($eve_ins_id))->with('danger', 'Usted ya cuenta con un registro, puede volver a descargar su formulario de inscripción.');
        } else {
            // PARA REGISTRO LIBRE
            $inscripcion = new EventoInscripcion();
            // $inscripcion->ei_rda = 0;
            $inscripcion->eve_ins_carnet_identidad = $request['eve_ins_carnet_identidad'];
            $inscripcion->eve_ins_carnet_complemento = $request['eve_ins_carnet_complemento']??'';
            $inscripcion->eve_ins_nombre_1 = $request['eve_ins_nombre_1'];
            $inscripcion->eve_ins_nombre_2 = $request['eve_ins_nombre_2']??'';
            $inscripcion->eve_ins_apellido_1 = $request['eve_ins_apellido_1']??'';
            $inscripcion->eve_ins_apellido_2 = $request['eve_ins_apellido_2']??'';
            // FECHA DE NACIMIENTO
            // $fechaNacimiento = $request['anio'] . '-' . $request['mes'] . '-' . $request['dia'];
            // $fechaNacimiento = $request['ei_fecha_nacimiento'];
            $inscripcion->eve_ins_fecha_nacimiento = $request['eve_ins_fecha_nacimiento'];
            $inscripcion->eve_correo = $request['eve_correo'];
            $inscripcion->eve_celular = $request['eve_celular'];
            $inscripcion->eve_ins_carnet_complemento = $request['eve_ins_carnet_complemento']??'';
            $inscripcion->gen_id = decrypt($request['gen_id']);
            $inscripcion->dep_id = decrypt($request['dep_id']);
            // $inscripcion->eve_id = 25;
            // NIVEL
            // $inscripcion->en_id = decrypt($request['en_id']);
            // $inscripcion->pm_id = decrypt($request['pm_id']);
            // MODALIDAD DE ASISTENCIA
            // $inscripcion->em_id = $request['em_id'];
            $inscripcion->eve_id = $request['eve_id'];

            // AUTORIZACIÓN
            // if ($request['ei_autorizacion']) {
            //     $inscripcion->ei_autorizacion = 1;
            // } else {
            //     $inscripcion->ei_autorizacion = 0;
            // }
            // MODALIDAD DE ASISTENCIA
            // if ($request['pm_id'] == 1) {
                // MODALIDAD PRESENCIAL - DE ACUERDO A LA INSTITUCIÓN
                $inscripcion->pm_id = $request['pm_id'];
            // }
            //

            // dd("siiiiii");
            $inscripcion->save();

            return redirect()->route('evento.comprobanteParticipante', encrypt($inscripcion->eve_ins_id));
        }
        //

    }
    public function comprobanteParticipante($ei_id)
    {
        //
        $data['eve_ins_id'] = $ei_id;
        //
        $data['evento'] = DB::table('evento')
            ->join('evento_inscripcion', 'evento_inscripcion.eve_id', '=', 'evento.eve_id')
            ->where('evento_inscripcion.eve_ins_id', '=', decrypt($ei_id))
            ->get();
        //
        return view('frontend.pages.evento.comprobanteParticipante', $data);
    }

    public function comprobanteParticipantePdf($eve_ins_id)
    {
        //
        $eve_ins_id = decrypt($eve_ins_id);
        //
        $participante = DB::table('evento_inscripcion')
            ->select(
                'evento_inscripcion.eve_ins_id',
                // 'evento_inscripcion.ei_rda',
                'evento_inscripcion.eve_ins_carnet_identidad',
                'evento_inscripcion.eve_ins_carnet_complemento',
                'evento_inscripcion.eve_ins_nombre_1',
                'evento_inscripcion.eve_ins_apellido_1',
                'evento_inscripcion.eve_ins_apellido_2',
                'evento_inscripcion.eve_celular',
                'evento_inscripcion.eve_correo',
                // 'evento_inscripcion.ei_autorizacion',
                'evento_inscripcion.eve_id',
                'evento_inscripcion.created_at',
                'programa_modalidad.pm_id',
                'programa_modalidad.pm_nombre',
                'evento.eve_nombre',
                'departamento.dep_nombre',
            )
            ->join('evento', 'evento.eve_id', '=', 'evento_inscripcion.eve_id')
            ->join('programa_modalidad', 'programa_modalidad.pm_id', '=', 'evento_inscripcion.pm_id')
            ->join('departamento', 'departamento.dep_id', '=', 'evento_inscripcion.dep_id')
            ->where('evento_inscripcion.eve_ins_id', '=', $eve_ins_id)
            ->get();
        //
        // dd($participante);
        //
        $imagen1 = public_path() . "/img/logos/logominedu.jpg";
        $logo1 = base64_encode(file_get_contents($imagen1));

        $imagen2 = public_path() . "/img/logos/logoprofe.jpg";
        $logo2 = base64_encode(file_get_contents($imagen2));

        $imagen3 = public_path() . "/img/iconos/alerta.png";
        $logo3 = base64_encode(file_get_contents($imagen3));

        $imagen3 = public_path() . "/img/logos/fondo.jpg";
        $fondo = base64_encode(file_get_contents($imagen3));

        // QR de encuesta
        $imagen4 = public_path() . "/img/qr/qrEncuesta.jpg";
        $qrEncuesta = base64_encode(file_get_contents($imagen4));
        //
        $datosQr = route('evento.comprobanteParticipantePdf', encrypt($eve_ins_id));
        //
        $qr = base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate($datosQr));
        $pdf = PDF::loadView('frontend.pages.evento.comprobantePdf', compact('participante', 'logo1', 'logo2', 'logo3', 'fondo', 'qr', 'qrEncuesta'));
        // VERTICAL
        $pdf->setPaper('Letter', 'portrait');
        // HORIZONTAL
        // $pdf->setPaper('Letter', 'landscape');
        //
        return $pdf->stream('comprobante' . $participante[0]->eve_ins_carnet_identidad . '.pdf');
        // return $pdf->download('mi-archivo.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
