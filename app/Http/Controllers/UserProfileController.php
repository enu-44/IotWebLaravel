<?php

namespace App\Http\Controllers;
use App\Http\Requests\ImageProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;


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



		$path = 'uploads';

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
