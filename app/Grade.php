<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Grade extends Model {
    protected $table = "grades";

    protected $fillable = array('score', 'exam_id', 'alumno_id');

    protected $hidden = ['maestro_id'];
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
   

    /**
     * Get the video.
     *
     * @return Video
     */
    public function exams() {
        return $this -> belongsTo('App\Exam');
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
      public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Clase', 'id', 'user_id');
    }
}