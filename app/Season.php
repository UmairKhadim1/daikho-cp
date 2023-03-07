<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $connection = 'mysql2'; //which is the default as well
    protected $table = 'cb_series_seasons';
    protected $primaryKey = 'videoid';
}
