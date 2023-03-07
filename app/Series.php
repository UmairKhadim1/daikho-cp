<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $connection = 'mysql2'; //which is the default as well
    protected $table = 'cb_series';
    protected $primaryKey = 'videoid';
}
