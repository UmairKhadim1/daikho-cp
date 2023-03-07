<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $connection = 'mysql2'; //which is the default as well
    protected $table = 'cb_video';
    protected $primaryKey = 'videoid';
}
