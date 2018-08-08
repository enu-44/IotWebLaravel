<?php

namespace App\Http\Controllers;

use App\Tipo_Proyecto;
use App\Proyectos;
use App\Unidad_Productiva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use File;

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
                    'tipo__proyectos.name_tipo_proyecto','unidad__productivas.id','unidad__productivas.name_unidad_productiva','unidad__productivas.description_unidad_productiva','unidad__productivas.path_unidad_productiva','unidad__productivas.proyecto_id')
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


    

    public function getEditUnidadProductiva(Request $request,$unidadproductiva_id)
    {
        $id = Crypt::decrypt($unidadproductiva_id);  
        $unidadproductiva = Unidad_Productiva::find($id);

        $usuario = Auth::user();
        $proyectos = Proyectos::join('tipo__proyectos', 'tipo__proyectos.id', '=', 'proyectos.tipo_proyecto_id')
                   ->where('proyectos.user_id', '=', $usuario->id)
                   ->select('proyectos.id', 'proyectos.name_proyecto', 'proyectos.description_proyecto', 'proyectos.tipo_proyecto_id',
                    'tipo__proyectos.name_tipo_proyecto')
                   ->get();
        
        return view('pages.unidad_productiva.edit_unidad_productiva',compact("proyectos","unidadproductiva"));
    }



    //metodo que se ejecuta para crear el perfil
    public function postUnidadesProductivas(Request $request)
    {
        //verificamos el usuario logueado
        $userLogued = Auth::user();
        $id =$request->get('id');
        $proyecto_id =$request->get('proyecto_id');
        $name =$request->get('name');
        $ubicacion_unidad_productiva =$request->get('ubicacion_unidad_productiva');
        $nit =$request->get('nit');
        $direccion =$request->get('direccion');
        $description =$request->get('description');
        $ciudad_residencia =$request->get('ciudad_residencia');
        $estado_residencia =$request->get('estado_residencia');
        $direccioncompleta =$request->get('direccioncompleta');

        $ubicacion =$request->get('ubicacion_unidad_productiva');
        $coordsMarker =$request->get('coordsMarker');
        $coordsPoligono =$request->get('coordsPoligono');
        $getRadius =$request->get('getRadius');
        $getCorrdenadasCirculo =$request->get('getCorrdenadasCirculo');
        $getNorthEastRectangulo =$request->get('getNorthEastRectangulo');
        $getSouthWestRectangulo =$request->get('getSouthWestRectangulo');

        $path = 'uploads/unidades_productivas';

        //UPDATE
        if($id>0){
            $this->validatorUpdate($request->all())->validate();
            $unidad_productiva = Unidad_Productiva::find($id);
            $ruta=$unidad_productiva->path_unidad_productiva;

            if($request->hasFile('icon'))
            {
               
                $image_path=  $unidad_productiva->path_unidad_productiva;
                if(!$image_path=="img/unidad_productiva_empty.png"){
                    if(File::exists($image_path)) {
                    File::delete($image_path);
                    } 
                }

                $files = $request->file('icon');
                $filename=sha1(Carbon::now()).uniqid().$files->getClientOriginalName();
                $ruta=$path."/".$filename;
                $files->move($path,$filename);
                $unidad_productiva->path_unidad_productiva=$ruta;
            }
            
            $retangulo="";
            if($getNorthEastRectangulo!=null && $getSouthWestRectangulo!=null){
                $retangulo=$getNorthEastRectangulo."|".$getSouthWestRectangulo;
            }
            
            $unidad_productiva->name_unidad_productiva=$name;
            $unidad_productiva->description_unidad_productiva=$description;
            $unidad_productiva->nit_unidad_productiva=$nit;
            $unidad_productiva->direccion_unidad_productiva=$direccion;

            $unidad_productiva->marker=$coordsMarker;
            $unidad_productiva->poligono=$coordsPoligono;
            $unidad_productiva->rectangulo=$retangulo;
            $unidad_productiva->circulo=$getCorrdenadasCirculo;
            $unidad_productiva->radius=$getRadius;
            $unidad_productiva->ciudad=$ciudad_residencia;
            $unidad_productiva->departamento=$estado_residencia;
            $unidad_productiva->direccion_completa_ciudad=$direccioncompleta;
            $unidad_productiva->proyecto_id=$proyecto_id;
            $unidad_productiva->coords_ubicacion=$ubicacion;
            
            $unidad_productiva->save();

        //POST
        }else{
        
            $this->validatorPost($request->all())->validate();
            $ruta="";
            $retangulo="";
            if($request->hasFile('icon'))
            {
                $files = $request->file('icon');
                $filename=sha1(Carbon::now()).uniqid().$files->getClientOriginalName();
                $ruta=$path."/".$filename;
                $files->move($path,$filename);
            }else{
                 $ruta="img/unidad_productiva_empty.png";
            }

            
            if($getNorthEastRectangulo!=null && $getSouthWestRectangulo!=null){
                $retangulo=$getNorthEastRectangulo."|".$getSouthWestRectangulo;
            }
          
        
            Unidad_Productiva::create([
                'name_unidad_productiva' => $name,
                'description_unidad_productiva' => $description,
                'nit_unidad_productiva' => $nit,
                'direccion_unidad_productiva' => $direccion,
                'path_unidad_productiva' => $ruta,
                'coords_ubicacion' => $ubicacion,
                'marker' => $coordsMarker,
                'poligono' => $coordsPoligono,
                'rectangulo' => $retangulo,
                'circulo' => $getCorrdenadasCirculo,
                'radius' => $getRadius,
                'ciudad' => $ciudad_residencia,
                'departamento' => $estado_residencia,
                'direccion_completa_ciudad' => $direccioncompleta,
                'proyecto_id' => $proyecto_id,
               
            ]);
        }
        return redirect('/unidades_productivas')->with('agregado', 'Item  guardado');
    }


    public function postDeleteUnidadProductiva(Request $request)
    {
        //verificamos la unidad productiva
        $unidadproductiva_id =$request->get('id');
        $this->validatorDelete($request->all())->validate();


        $unidadproductiva = Unidad_Productiva::find($unidadproductiva_id);

        if(!$unidadproductiva->path_unidad_productiva=="img/unidad_productiva_empty.png"){
            if(File::exists($unidadproductiva->path_unidad_productiva)) {
            File::delete($unidadproductiva->path_unidad_productiva);
            } 
        }
       
        $unidadproductiva->delete();
        return redirect('/unidades_productivas')->with('eliminado', 'Item eliminado');
    }

    //VALIDACIONES
    /*---------------------------------------------------------------------------------*/
    protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'proyecto_id' => 'required', //tamaño maximo de la imagen que se va subir
            'name' => 'required|max:255', 
            'ubicacion_unidad_productiva' => 'required',
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'proyecto_id' => 'required', //tamaño maximo de la imagen que se va subir
            'name' => 'required|max:255', //tamaño maximo de la imagen que se va subir
            'ubicacion_unidad_productiva' => 'required',
        ]);
    }

    protected function validatorDelete(array $data)
    {
        return Validator::make($data, [
           'id' => 'required|exists:unidad__productivas,id'
        ]);
    }
}
