<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad_Productiva extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'unidad__productivas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'name_unidad_productiva',
	'description_unidad_productiva',
	'nit_unidad_productiva',
	'direccion_unidad_productiva',
	'path_unidad_productiva',
	'marker',
	'poligono',
	'rectangulo',
	'circulo',
	'radius',
	'ciudad',
	'departamento',
	'proyecto_id',
	];

	public function HasManyDispositivos(){
		return $this->hasMany('App\Dispositivo.php');
	}

    public function propietarioProyecto(){

        return $this->belongsTo('App\Proyectos');
    }
}



