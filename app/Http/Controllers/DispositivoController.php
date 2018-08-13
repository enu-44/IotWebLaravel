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

class DispositivoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDispositivos()
    {
        $usuario = Auth::user();
        $dispositivos = Dispositivo::join('unidad__productivas', 'unidad__productivas.id', '=', 'dispositivos.unidad_productiva_id')
            ->join('tipo__dispositivos', 'tipo__dispositivos.id', '=', 'dispositivos.tipo_dispositivo_id')
            ->join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
            ->join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
            ->where('proyectos.user_id', '=', $usuario->id)
            ->select('dispositivos.id','dispositivos.id_externo','tipo__dispositivos.name_tipo_dispositivos','dispositivos.name as name_dispositivo','dispositivos.unidad_productiva_id','proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id','tipo__proyectos.name_tipo_proyecto','unidad__productivas.name_unidad_productiva','unidad__productivas.description_unidad_productiva','unidad__productivas.path_unidad_productiva','unidad__productivas.proyecto_id')
            ->get();

        return view('pages.dispositivos',compact("dispositivos"));
    }


    public function getAddDispositivo()
    {
        $usuario = Auth::user();

        $tipo_dispositivos= Tipo_Dispositivo::all();
        
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();
      
        return view('pages.dispositivos.add_dispositivo',compact("proyectos","tipo_dispositivos"));
    }


    

    public function getEditDispositivo(Request $request,$dispositivo_id)
    {
        $id = Crypt::decrypt($dispositivo_id);  
        $dispositivo = Dispositivo::find($id);

        $tipo_dispositivos= Tipo_Dispositivo::all();

        $usuario = Auth::user();
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

        $dispositivo_join = Dispositivo::join('unidad__productivas', 'unidad__productivas.id', '=', 'dispositivos.unidad_productiva_id')
                ->join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
                ->where('dispositivos.id', '=', $dispositivo->id)
                ->select('proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id','unidad__productivas.id','unidad__productivas.name_unidad_productiva','unidad__productivas.proyecto_id')
                ->first();


        return view('pages.dispositivos.edit_dispositivo',compact("proyectos","dispositivo","tipo_dispositivos",'dispositivo_join'));
    }

    //metodo que se ejecuta para crear el perfil
    public function postDispositivos(Request $request)
    {
        //verificamos el usuario logueado
        $userLogued = Auth::user();

        $id =$request->get('id');
        $dispositivos_remotos =$request->get('dispositivos_remotos');
        $mac =$request->get('mac');
        $marca =$request->get('marca');
        $cellular =$request->get('cellular');
        $connected =$request->get('connected');
        $current_build_target =$request->get('current_build_target');
        $id_externo =$request->get('id_externo');
        $imei =$request->get('imei');
        $last_app =$request->get('last_app');

        $last_heard =$request->get('last_heard');
        $last_iccid =$request->get('last_iccid');
        $last_ip_address =$request->get('last_ip_address');
        $name =$request->get('name');
        $platform_id =$request->get('platform_id');
        $product_id =$request->get('product_id');

        $status =$request->get('status');
        $coords_dispositivo =$request->get('coords_dispositivo');
        $descripcion_dispositivo =$request->get('descripcion_dispositivo');

        $unidadproductiva_id =$request->get('unidadproductiva_id');
        $tipo_dispositivo_id =$request->get('tipo_dispositivo_id');
        $dispositivos_remotos =$request->get('dispositivos_remotos');

        

        

        //UPDATE
        if($id>0){
            $this->validatorUpdate($request->all())->validate();
            $dispositivo = Dispositivo::find($id);
                    
            $dispositivo->coords_dispositivo=$coords_dispositivo;
            $dispositivo->mac=$mac;
            $dispositivo->marca=$marca;
            $dispositivo->descripcion_dispositivo=$descripcion_dispositivo;

            $dispositivo->cellular=$cellular;
            $dispositivo->connected=$connected;
            $dispositivo->current_build_target=$current_build_target;
            $dispositivo->id_externo=$id_externo;
            $dispositivo->imei=$imei;
            $dispositivo->last_app=$last_app;
            $dispositivo->last_heard=$last_heard;
            $dispositivo->last_iccid=$last_iccid;
            $dispositivo->last_ip_address=$last_ip_address;
            $dispositivo->name=$name;
            $dispositivo->platform_id=$platform_id;
            $dispositivo->product_id=$product_id;
            $dispositivo->status=$status;
            $dispositivo->tipo_dispositivo_id=$tipo_dispositivo_id;
            $dispositivo->unidad_productiva_id=$unidadproductiva_id;
            $dispositivo->dispositivo_id=$dispositivos_remotos;

            $dispositivo->save();

        //POST
        }else{
        
            $this->validatorPost($request->all())->validate();
            Dispositivo::create([
                'coords_dispositivo' => $coords_dispositivo,
                'mac' => $mac,
                'marca' => $marca,
                'descripcion_dispositivo' => $descripcion_dispositivo,
                'cellular' => $cellular,
                'connected' => $connected,
                'id_externo' => $id_externo,
                'imei' => $imei,
                'last_app' => $last_app,
                'last_heard' => $last_heard,
                'last_iccid' => $last_iccid,
                'last_ip_address' => $last_ip_address,
                'platform_id' => $platform_id,
                'product_id' => $product_id,
                'status' => $status,

                'name' => $name,
                'tipo_dispositivo_id' => $tipo_dispositivo_id,
                'unidad_productiva_id' => $unidadproductiva_id,
                'dispositivo_id' => $dispositivos_remotos,
               
            ]);
        }
        return redirect('/dispositivos')->with('agregado', 'Item  guardado');
    }


    public function postDeleteDispositivo(Request $request)
    {
        //verificamos la unidad productiva
        $dispositivo_id =$request->get('id');
        $this->validatorDelete($request->all())->validate();
        $dispositivo = Dispositivo::find($dispositivo_id);
        $dispositivo->delete();
        return redirect('/dispositivos')->with('eliminado', 'Item eliminado');
    }



    //VALIDACIONES
    /*---------------------------------------------------------------------------------*/
    protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'coords_dispositivo' => 'required', //tamaño maximo de la imagen que se va subir
            'id_externo' => 'required', 
            'name' => 'required', 
            'tipo_dispositivo_id' => 'required', 
            'unidadproductiva_id' => 'required', 
            'dispositivos_remotos'=>'required',
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
           'coords_dispositivo' => 'required', //tamaño maximo de la imagen que se va subir
            'id_externo' => 'required', 
            'name' => 'required', 
            'tipo_dispositivo_id' => 'required', 
            'unidadproductiva_id' => 'required', 
        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:dispositivos,id'
        ]);
    }
}
