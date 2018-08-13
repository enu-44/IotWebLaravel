<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dispositivos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'coords_dispositivo',
	'mac',
	'marca',
	'descripcion_dispositivo',
	'cellular',
	'connected',
	'current_build_target',
	'id_externo',
	'imei',
	'last_app',
	'last_heard',
	'last_iccid',
	'last_ip_address',
    'name',
    'platform_id',
    'product_id',
    'status',
    'tipo_dispositivo_id',
    'unidad_productiva_id',
    'dispositivo_id',
	];

	public function HasManyConfigurationVariables(){
		return $this->hasMany('App\Configuracion_Variable.php');
	}

    public function propietarioTipoDispositivo(){

        return $this->belongsTo('App\Tipo_Dispositivo');
    }

     public function propietarioUnidadProductiva(){

        return $this->belongsTo('App\Unidad_Productiva');
    }
}
