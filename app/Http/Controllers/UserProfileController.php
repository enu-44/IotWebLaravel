<?php

namespace App\Http\Controllers;
use App\Http\Requests\ImageProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use File;

class UserProfileController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }



    public function getProfile()
    {
        return view('pages.profile');
    }



    //metodo que se ejecuta para crear el perfil
	public function postChangeImageProfile(ImageProfileRequest $request)
	{
		//verificamos el usuario logueado
		$userLogued = Auth::user();
        $image_path = $userLogued->path;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

		$path = 'uploads/perfil';

		$files = $request->file('image');
        $filename=uniqid().$files->getClientOriginalName();
        $ruta=$path."/".$filename;
        $files->move($path,$filename);

        $user = User::find($userLogued->id);
		$user->path=$ruta;
        $user->save();

		return redirect("/profile_user");

	}



    public function postUserLoguedBasic(Request $request)
    {
        //verificamos el usuario logueado
        $userLogued = Auth::user();

        $name =$request->get('name');
        $last_name =$request->get('last_name');
        $identification =$request->get('identification');

        $userLogued->name=$name;
        $userLogued->last_name=$last_name;
        $userLogued->identification=$identification;
        $userLogued->save();

        

        return redirect("/profile_user");
    }


     public function postUserLoguedContact(Request $request)
    {
        //verificamos el usuario logueado
        $userLogued = Auth::user();

        $address =$request->get('address');
        $phone =$request->get('phone');
            
        $userLogued->phone=$phone;
        $userLogued->address=$address;
        $userLogued->save();

        return redirect("/profile_user");
    }


    protected function validatorUpdateInfoBasica(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', //tamaño maximo de la imagen que se va subir
            'last_name' => 'required', 
            'identification' => 'required', 
        ]);
    }

   

}
