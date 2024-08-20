<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunicado;

class ComunicadoController extends Controller
{
    // Programas
    public function index()
    {
        $comunicados = Comunicado::where('comun_estado', 'activo')->orderBy('comun_id', 'DESC')->get();

        return view('frontend.pages.comunicado.index', compact('comunicados'));
    }

    public function show($pro_id)
    {
        $comunicado = Comunicado::where('comun_estado', 'activo')->where('comun_id', $pro_id)->first();

        return view('frontend.pages.comunicado.comunicado', compact('comunicado'));
    }
}
