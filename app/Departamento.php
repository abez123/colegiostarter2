<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Departamento extends Model {

	/**
	 * The attributes included in the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('nombre', 'depa_code', 'descripcion', 'icon');
	
	/**
	 * The rules for email field, automatic validation.
	 *
	 * @var array
	*/
	private $rules = array(
			'nombre' => 'required|min:2',
			'depa_code' => 'required|min:2'
	);
	
	public function getImageUrl( $withBaseUrl = false )
	{
		if(!$this->icon) return NULL;
		
		$imgDir = '/images/departamento/' . $this->id;
		$url = $imgDir . '/' . $this->icon;
		
		return $withBaseUrl ? URL::asset( $url ) : $url;
	}

    public function grupo()
    {
        return $this->hasMany('App\Grupo');
    }
}
