<?php

namespace App\Http\Controllers;


use App\Configuracion_Variable;
use App\Tipo_Variable;
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

class ConfigurarVariablesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getConfiguracionVariable()
    {
    	
    	$usuario = Auth::user();
    	$configuracion_variables = Configuracion_Variable::join('dispositivos', 'dispositivos.id', '=', 'configuracion__variables.dispositivo_id')
    	          ->join('tipo__dispositivos', 'tipo__dispositivos.id', '=', 'dispositivos.tipo_dispositivo_id')
    	          ->join('unidad__productivas', 'unidad__productivas.id', '=', 'dispositivos.unidad_productiva_id')
    	           ->join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
                  ->where('proyectos.user_id', '=', $usuario->id)
                  ->select(
                  	'configuracion__variables.name_configure','configuracion__variables.alias_variable',
                  	'configuracion__variables.id','configuracion__variables.dispositivo_id','dispositivos.id_externo','tipo__dispositivos.name_tipo_dispositivos','dispositivos.name as name_dispositivo','dispositivos.unidad_productiva_id','proyectos.name_proyecto', 'proyectos.description_proyecto','unidad__productivas.name_unidad_productiva','unidad__productivas.description_unidad_productiva','unidad__productivas.path_unidad_productiva','unidad__productivas.proyecto_id')
                  ->get();

        return view('pages.configuracion_variables.index',compact("configuracion_variables"));
    }


    public function getAddConfiguracionVariable()
    {
        $usuario = Auth::user();

        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();


        $tipo_variables= Tipo_Variable::all();
      
        return view('pages.configuracion_variables.add_conf_variable',compact("proyectos","tipo_variables"));
    }


    public function getEditConfiguracionVariable(Request $request,$configuracion_variable_id)
    {
        $id = Crypt::decrypt($configuracion_variable_id);  
        $configuracion_variable = Configuracion_Variable::find($id);





        $usuario = Auth::user();
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();

        $config_variable_join = Configuracion_Variable::join('dispositivos', 'dispositivos.id', '=', 'configuracion__variables.dispositivo_id')
        ->join('unidad__productivas', 'unidad__productivas.id', '=', 'dispositivos.unidad_productiva_id')
                ->join('proyectos', 'proyectos.id', '=', 'unidad__productivas.proyecto_id')
                ->where('configuracion__variables.id', '=', $configuracion_variable->id)
                ->select('proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id','unidad__productivas.id as unidad_productiva_id','unidad__productivas.name_unidad_productiva','unidad__productivas.proyecto_id')
                ->first();

        
        $tipo_variables= Tipo_Variable::all();

        return view('pages.configuracion_variables.edit_conf_variable',compact("proyectos","tipo_variables","configuracion_variable","config_variable_join"));
    }

     //metodo que se ejecuta para crear un tipo proyecto
	public function postConfiguracionVariable(Request $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
		$id =$request->get('id');
		$coreid_configure =$request->get('coreid_configure');
		$name_configure =$request->get('name_configure');
        $alias_variable =$request->get('alias_variable');
        $dispositivo_id =$request->get('dispositivo_id');
        $tipo_variable_id =$request->get('tipo_variable_id');
        

		if($id>0){
			$this->validatorUpdate($request->all())->validate();
			$configuracion_variable = Configuracion_Variable::find($id);
            $tipo_variable = Tipo_Variable::find($tipo_variable_id);
			
			$configuracion_variable->coreid_configure=$coreid_configure;
			$configuracion_variable->name_configure=$name_configure;
            $configuracion_variable->alias_variable=$tipo_variable->name_tipo_variables;
            $configuracion_variable->dispositivo_id=$dispositivo_id;
            $configuracion_variable->tipo_variable_id=$tipo_variable_id;

            

			$configuracion_variable->save();

		}else{
			$this->validatorPost($request->all())->validate();

            $tipo_variable = Tipo_Variable::find($tipo_variable_id);

	        Configuracion_Variable::create([
	            'coreid_configure' => $coreid_configure,
	            'name_configure' => $name_configure,
                'alias_variable' => $tipo_variable->name_tipo_variables,
                'dispositivo_id' => $dispositivo_id,
                'tipo_variable_id' => $tipo_variable_id,
	        ]);
		}

		return redirect('/configurarvariables')->with('agregado', 'Item  guardado');
	}



	public function postDeleteConfiguracionVariable(Request $request)
	{
		//verificamos el usuario logueado
		$configuracion_variable_id =$request->get('id');
		$this->validatorDelete($request->all())->validate();
		$configuracion_variable = Configuracion_Variable::find($configuracion_variable_id);
        $configuracion_variable->delete();
        return redirect('/configurarvariables')->with('eliminado', 'Item eliminado');
	}



	//VALIDACIONES
	/*---------------------------------------------------------------------------------*/
	protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'coreid_configure' => 'required', //tamaño maximo de la imagen que se va subir
            'name_configure' => 'required', 
            'dispositivo_id' => 'required', 
            'tipo_variable_id'=> 'required',
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'coreid_configure' => 'required', //tamaño maximo de la imagen que se va subir
            'name_configure' => 'required', 
            'dispositivo_id' => 'required', 
            'tipo_variable_id'=> 'required',

        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:configuracion__variables,id'
        ]);
    }
}
