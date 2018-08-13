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

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list Unidad productiva by proyecto
    public function postUnidadesproductivasByProyecto()
    {
        $proyecto_id = Input::get('proyecto_id');
        $unidades_productivas=Unidad_Productiva::where('proyecto_id', '=', $proyecto_id )->get();
        $arr['success'] = true;
        $arr['unidades_productivas'] =  $unidades_productivas;
        return json_encode($arr);
    }

    
    //get  unidad productiva by Id
    public function postUnidadesproductivasById()
    {
        $unidad_productiva_id = Input::get('unidadproductiva_id');
        $unidad_productiva=Unidad_Productiva::join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
                    ->where('unidad__productivas.id', '=', $unidad_productiva_id )
                    ->first();
        $arr['success'] = true;
        $arr['unidad_productiva'] =  $unidad_productiva;
        return json_encode($arr);
    }

    //get list dispositivos by Unidadprouctiva
    public function postDispositivosByIdUp()
    {
        $unidad_productiva_id = Input::get('unidadproductiva_id');
        $dispositivos=Dispositivo::join('tipo__dispositivos', 'tipo__dispositivos.id', '=', 'dispositivos.tipo_dispositivo_id')
                    ->where('dispositivos.unidad_productiva_id', '=', $unidad_productiva_id )
                    ->select('dispositivos.id','dispositivos.id_externo','tipo__dispositivos.name_tipo_dispositivos','dispositivos.name as name_dispositivo','dispositivos.unidad_productiva_id','dispositivos.tipo_dispositivo_id','dispositivos.coords_dispositivo','dispositivos.dispositivo_id','dispositivos.descripcion_dispositivo','dispositivos.name')
                    ->get();

        $arr['success'] = true;
        $arr['dispositivos'] =  $dispositivos;
        return json_encode($arr);
    }

    ///Get dispositivo by Id
    public function postDispositivoById()
    {
        $dispositivo_id = Input::get('dispositivo_id');
        $dispositivo=Dispositivo::where('id', '=', $dispositivo_id )->first();
        $arr['success'] = true;
        $arr['dispositivo'] =  $dispositivo;
        return json_encode($arr);
    }
}
