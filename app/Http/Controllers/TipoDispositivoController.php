<?php

namespace App\Http\Controllers;

use App\Tipo_Dispositivo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TipoDispositivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTipoDispositivos()
    {
    	$tipo_dispositivos= Tipo_Dispositivo::all();
        return view('pages.administrator.tipo_dispositivos',compact("tipo_dispositivos"));
    }

     //metodo que se ejecuta para crear un tipo proyecto
	public function postTipoDispositivos(Request $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
		$id =$request->get('id');
		$name =$request->get('name');
		$description =$request->get('description');

		if($id>0){
			$this->validatorUpdate($request->all())->validate();
			$tipo_proyecto = Tipo_Dispositivo::find($id);
			
			$tipo_proyecto->name_tipo_dispositivos=$name;
			$tipo_proyecto->description_tipo_dispositivos=$description;
			$tipo_proyecto->save();

		}else{
			$this->validatorPost($request->all())->validate();
	        Tipo_Dispositivo::create([
	            'name_tipo_dispositivos' => $name,
	            'description_tipo_dispositivos' => $description,
	        ]);
		}

		return redirect('/tipodispositivos')->with('agregado', 'Item  guardado');
	}



	public function postDeleteTipoDispositivos(Request $request)
	{
		//verificamos el usuario logueado
		$tipodispositivo_id =$request->get('id');
		$this->validatorDelete($request->all())->validate();
		$tipo_dispositivo = Tipo_Dispositivo::find($tipodispositivo_id);
        $tipo_dispositivo->delete();
        return redirect('/tipodispositivos')->with('eliminado', 'Item eliminado');
	}



	//VALIDACIONES
	/*---------------------------------------------------------------------------------*/
	protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:tipo__dispositivos,id'
        ]);
    }
}
