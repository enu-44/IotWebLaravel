<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
     /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'proyectos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'name_proyecto','description_proyecto','tipo_proyecto_id','user_id'
	];



	public function HasManyUnidadesProductivas(){
		return $this->hasMany('App\Unidad_Productiva.php');
	}


    public function propietarioTipoProyecto(){

        return $this->belongsTo('App\Tipo_Proyecto');
    }


    public function propietarioUser(){

        return $this->belongsTo('App\User');
    }


}


