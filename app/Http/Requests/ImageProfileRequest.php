<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        
            'image' => 'required|image|max:20000|mimes:jpeg,jpg,bmp,png,gif', //tamaño maximo de la imagen que se va subir

        ];
    }
}
