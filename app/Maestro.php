<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Maestro extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'maestros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'nombre', 'apellido_p','apellido_m','username', 'sexo','direcion','colonia','cp','telefonos','profesion','mision','cursos','email', 'password', 'confirmed' ,'admin','confirmation_code' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ,'confirmation_code'  ];


    public function exams()
    {
        return $this->hasMany('App\Exam');
    }

    public function Clase()
    {
        return $this->belongsTo('App\Clase');
    }

}