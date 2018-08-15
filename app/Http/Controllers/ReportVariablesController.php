<?php

namespace App\Http\Controllers;

use App\Tipo_Dispositivo;
use App\Tipo_Proyecto;
use App\Proyectos;
use App\Unidad_Productiva;
use App\Dispositivo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use File;
use Illuminate\Support\Facades\Input;

class ReportVariablesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function getVariablesRealTime()
    {
    	
    	$usuario = Auth::user();

        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

        return view('pages.variables.variables_real_time',compact("proyectos"));
    }

    public function getHistorialVariables()
    {
        
        $usuario = Auth::user();

        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

        return view('pages.variables.historial.historial_variables',compact("proyectos"));
    }


    public function getMapaVariables()
    {
        
        $usuario = Auth::user();

        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

        return view('pages.mapa.report_mapa',compact("proyectos"));
    }


    
}
