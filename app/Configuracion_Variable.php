<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion_Variable extends Model
{
     /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'configuracion__variables';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'coreid_configure',
	'name_configure',
	'alias_variable',
	'dispositivo_id',
	'tipo_variable_id',
	];

	
    public function propietarioDispositivo(){
        return $this->belongsTo('App\Dispositivo');
    }

    public function propietarioTipoVariable(){
        return $this->belongsTo('App\Tipo_Variable');
    }
}