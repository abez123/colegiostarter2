<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Clase extends Model {

    protected $table = 'clases';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','lunesi','lunesf','martesi','martesf','miercolesi','miercolesf','juevesi','juevesf','viernesi','viernesf','sabadoi','sabadof','grupo_id','maestro_id','materia_id','confirmed'];


    /**
     * Deletes a video
     *
     */
    public function delete() {
        // Delete the post
        return parent::delete();
    }

    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */

    /**
     * Get the author.
     *
     * @return User
     */


    /**
     * Get the video.
     *
     * @return Video
     */


    /**
     * Get the video's language.
     *
     * @return Language
     */
    public function users()
    {
        return $this->hasMany('App\User');

    }
    public function materias()
    {
        return $this->hasOne('App\Materia');
    }

    public function maestros()
    {
        return $this->hasOne('App\Maestro');
    }

    public function grupos()
    {
        return $this->hasOne('App\Grupo');
 
    }

}

















