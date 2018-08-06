<?php

namespace App\Http\Controllers;

use App\Tipo_Proyecto;
use App\Proyectos;
use App\Unidad_Productiva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UnidadProductivaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUnidadProductiva()
    {
        $usuario = Auth::user();
        $unidades_productivas = Unidad_Productiva::join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
        ->join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                   ->select('proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto','unidad__productivas.name_unidad_productiva','unidad__productivas.description_unidad_productiva','unidad__productivas.path_unidad_productiva','unidad__productivas.proyecto_id')
                   ->get();

        return view('pages.unidad_productiva',compact("unidades_productivas"));
    }


    public function getAddUnidadProductiva()
    {
        $usuario = Auth::user();
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

      
        return view('pages.unidad_productiva.add_unidad_productiva',compact("proyectos"));
    }
}
