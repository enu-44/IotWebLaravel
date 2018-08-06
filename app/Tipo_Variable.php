<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Tipo_Variable extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipo__variables';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id',
	'name_tipo_variables','sigla_tipo_variables','description_tipo_variables'
	];

	
	public function HasManyConfigurationVariables(){
		return $this->hasMany('App\Configuracion_Variable.php');
	}
}