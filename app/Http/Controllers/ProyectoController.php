<?php

namespace App\Http\Controllers;

use App\Tipo_Proyecto;
use App\Proyectos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProyectos()
    {
        $usuario = Auth::user();
        $tipo_proyectoslist= Tipo_Proyecto::all();
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                    ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();
        return view('pages.proyectos',compact("proyectos","tipo_proyectoslist"));
    }



     //metodo que se ejecuta para crear un tipo proyecto
	public function postProyectos(Request $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
		$id =$request->get('id');
		$name =$request->get('name');
		$description =$request->get('description');
		$tipo_proyecto_id =$request->get('tipo_proyecto_id');

		if($id>0){
			$this->validatorUpdate($request->all())->validate();
			$proyecto = Proyectos::find($id);
			$proyecto->name_proyecto=$name;
			$proyecto->description_proyecto=$description;
            $proyecto->tipo_proyecto_id=$tipo_proyecto_id;
			$proyecto->save();

		}else{
			$this->validatorPost($request->all())->validate();
	        Proyectos::create([
	            'name_proyecto' => $name,
	            'description_proyecto' => $description,
	            'tipo_proyecto_id' => $tipo_proyecto_id,
	            'user_id' => $userLogued->id,
	        ]);
		}

		return redirect('/proyectos')->with('agregado', 'Item  guardado');
	}



	public function postDeleteProyecto(Request $request)
	{
		//verificamos el usuario logueado
		$proyecto_id =$request->get('id');
		$this->validatorDelete($request->all())->validate();
		$proyecto = Proyectos::find($proyecto_id);
        $proyecto->delete();
        return redirect('/proyectos')->with('eliminado', 'Item eliminado');
	}



	//VALIDACIONES
	/*---------------------------------------------------------------------------------*/
	protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'tipo_proyecto_id' => 'required', 
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'description' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'tipo_proyecto_id' => 'required', 
        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:proyectos,id'
        ]);
    }
}
