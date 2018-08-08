<?php

namespace App\Http\Controllers;


use App\Tipo_Variable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TipoVariableController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTipoVariable()
    {
    	$tipo_variables= Tipo_Variable::all();
        return view('pages.administrator.tipo_variable',compact("tipo_variables"));
    }

    //metodo que se ejecuta para crear un tipo proyecto
	public function postTipoVariable(Request $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
		$id =$request->get('id');
		$name =$request->get('name');
		$sigla =$request->get('sigla');
		$description =$request->get('description');

		if($id>0){
			$this->validatorUpdate($request->all())->validate();
			$tipo_variable = Tipo_Variable::find($id);
			
			$tipo_variable->name_tipo_variables=$name;
			$tipo_variable->sigla_tipo_variables=$sigla;
			$tipo_variable->description_tipo_variables=$description;
			$tipo_variable->save();

		}else{
			$this->validatorPost($request->all())->validate();
	        Tipo_Variable::create([
	            'name_tipo_variables' => $name,
	            'sigla_tipo_variables' => $sigla,
	            'description_tipo_variables' => $description,
	        ]);
		}

		return redirect('/tipovariables')->with('agregado', 'Item  guardado');
	}



	public function postDeleteTipoVariable(Request $request)
	{
		//verificamos el usuario logueado
		$tipovariable_id =$request->get('id');
		$this->validatorDelete($request->all())->validate();
		$tipo_variable = Tipo_Variable::find($tipovariable_id);
        $tipo_variable->delete();
        return redirect('/tipovariables')->with('eliminado', 'Item eliminado');
	}

	//VALIDACIONES
	/*---------------------------------------------------------------------------------*/
	protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
             'sigla' => 'required|max:10', //tamaño maximo de la imagen que se va subir
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'sigla' => 'required|max:10', //tamaño maximo de la imagen que se va subir
        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:tipo__variables,id'
        ]);
    }
}
