<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Movie;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client = new Client();
        // $apiResponse = $client->request('GET', 'https://deikho.com/api/videos/list/');

        // $response = json_decode($apiResponse->getBody()->getContents(), true);
        // $movies = $response['videos'];
        $movies=Movie::where('series_id',0)
        ->where('active','yes')
        ->where('season_id',0)
        ->where('status','Successful')
        ->orderBy('date_added', 'desc')
        ->get();
        
        
        return view('movies',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
       
        $status = DB::connection('mysql2')->select('select is_free from cb_video where videoid='.$id);
        
        
      
        if ($status[0]->is_free == 0) {
            $duration=  DB::connection('mysql2')->select('select duration from cb_video where videoid='.$id);
            
            DB::connection('mysql2')->select('UPDATE cb_video SET is_free=1 , free_duration='.$duration[0]->duration.' WHERE videoid='.$id);
       $result=   DB::connection('mysql2')->select('select is_free , free_duration from cb_video where videoid='.$id);
            return response()->json(['success' => 'Video is free now','result'=>$result]);
        } else {
            DB::connection('mysql2')->select('UPDATE cb_video SET is_free=0 , free_duration=0 WHERE videoid='.$id);
            $result=   DB::connection('mysql2')->select('select is_free , free_duration from cb_video where videoid='.$id);


            return response()->json(['success' => 'Removed as free','result'=>$result]);
        }
    }

    public function updateTime( $id, $time){
        $id=(int)$id;
        $time=(int)$time;
        DB::connection('mysql2')->select('UPDATE cb_video SET free_duration='.$time.' WHERE videoid='.$id);
        return response()->json(['success' => '200']);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
