<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Materia extends Model {



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
    public function departamento() {
        return $this -> belongsTo('App\Departamento', 'departamento_id');
    }

    /**
     * Get the video's language.
     *
     * @return Language
     */

}
