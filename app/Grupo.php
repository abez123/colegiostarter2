<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Grupo extends Model {

    /**
     * Deletes a video
     *
     * @return bool
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
    public function content() {
        return nl2br($this -> content);
    }

    /**
     * Get the author.
     *
     * @return User
     */
    public function author() {
        return $this -> belongsTo('App\User', 'user_id');
    }

    /**
     * Get the video.
     *
     * @return Video
     */
    public function departamento() {
        return $this -> belongsTo('App\Departamento', 'departamento_id');
    }

    /**
     * Get the video's language.
     *
     * @return Language
     */
    public function alumno()
    {
        return $this->hasMany('App\Alumno');
    }
}
