<?php

namespace App\Http\Controllers;


use App\Tipo_Proyecto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TipoProyectosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTipoProyectos()
    {
    	$tipo_proyectos= Tipo_Proyecto::all();
        return view('pages.administrator.tipo_proyectos',compact("tipo_proyectos"));
    }

     //metodo que se ejecuta para crear un tipo proyecto
	public function postTipoProyectos(Request $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
		$id =$request->get('id');
		$name =$request->get('name');
		$description =$request->get('description');

		if($id>0){
			$this->validatorUpdate($request->all())->validate();
			$tipo_proyecto = Tipo_Proyecto::find($id);
			
			$tipo_proyecto->name_tipo_proyecto=$name;
			$tipo_proyecto->description_tipo_proyecto=$description;
			$tipo_proyecto->save();

		}else{
			$this->validatorPost($request->all())->validate();
	        Tipo_Proyecto::create([
	            'name_tipo_proyecto' => $name,
	            'description_tipo_proyecto' => $description,
	        ]);
		}

		return redirect('/tipoproyectos')->with('agregado', 'Item  guardado');
	}



	public function postDeleteTipoProyectos(Request $request)
	{
		//verificamos el usuario logueado
		$tipoproyecto_id =$request->get('id');
		$this->validatorDelete($request->all())->validate();
		$tipo_proyecto = Tipo_Proyecto::find($tipoproyecto_id);
        $tipo_proyecto->delete();
        return redirect('/tipoproyectos')->with('eliminado', 'Item eliminado');
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
           'id' => 'required|exists:tipo__proyectos,id'
        ]);
    }

}
