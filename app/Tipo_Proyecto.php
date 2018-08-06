<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Proyecto extends Model
{
     /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipo__proyectos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'name_tipo_proyecto','description_tipo_proyecto'
	];

	
	public function HasManyProyectos(){
		return $this->hasMany('App\Proyectos.php');
	}
}