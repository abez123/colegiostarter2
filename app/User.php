<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','apellidop','apellidom','sexo','direccion','colonia','cp','telefonos','grupo_id','padre_id','madre_id','fecha_nacimiento','historial_medico','profesion','mision','cursos', 'username', 'email', 'password','admin', 'confirmed', 'confirmation_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'confirmation_code'];




    public function articles()
    {
        return $this->hasMany('App\Article');
    }

 public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }

    public function padre()
    {
        return $this->belongsTo('App\Padre');
    }

    public function madre()
    {
        return $this->belongsTo('App\Madre');
    }

    public function clases()
    {
        return $this->belongsTo('App\Clase');
    }
 public function grades()
    {
        return $this->hasMany('App\Grade');
    }


}