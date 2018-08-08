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

}
