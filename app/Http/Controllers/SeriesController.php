<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {

        $sql = " SELECT t1.series_id,t2.series_name, GROUP_CONCAT(DISTINCT t1.season_id SEPARATOR ',') AS ids
            FROM cb_series_seasons t1 INNER JOIN cb_series t2
            ON t1.series_id = t2.series_id
            GROUP BY t1.series_id";
        $series = DB::connection('mysql2')->select($sql);
        //   return explode(',', $series[27]->ids);
        return view('series', compact('series'));
    }

    public function getSeason($series_id, $season_id,$key)
    {   


        $season = Movie::where('series_id', $series_id)
            ->where('active', 'yes')
            ->where('season_id', $season_id)
            ->where('status', 'Successful')
            ->orderBy('date_added', 'desc')
            ->get();
           $name= DB::connection('mysql2')->select('select series_name from cb_series where series_id='.$series_id);
        return view('season', compact('season','name','key'));
    }

}
