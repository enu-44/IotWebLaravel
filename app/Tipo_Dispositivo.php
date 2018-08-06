<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Dispositivo extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipo__dispositivos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'name_tipo_dispositivos','description_tipo_dispositivos'
	];

	
	public function HasManyWallets(){
		return $this->hasMany('App\Dispositivo.php');
	}

}
