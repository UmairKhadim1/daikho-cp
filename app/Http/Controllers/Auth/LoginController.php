<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username(){
        return 'username';
    }
    
    public function login(Request $request)

    {   

        $input = $request->all();

   

        $this->validate($request, [

            'username' => 'required',

            'password' => 'required',

        ]);
            $pas=md5(md5(sha1(sha1(md5($request->password)))));
            
            $user= DB::connection('mysql2')->select('select * from cb_users where username="'.$request->username.'"');
           // return $user[0]->password;
        if($user)

        {   if ($user[0]->password==$pas) {
            \Auth::loginUsingId($user[0]->userid);

            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')

            ->with('error','Password Is Wrong.');
        }

           

            
            

        }else{

            return redirect()->route('login')

                ->with('error','User Not Found.');

        }

          

    }
    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     // $client = new Client();
    //     // $url = 'https://api.deikho.com/dashboard/login';

    //     // $requestAPI = $client->post($url, [
            
    //     //     'form_params' => [
    //     //         'username'=>$request->username,
    //     //         'password'=>$request->password
    //     //     ] ,
    //     // ]);
    //     // $rapid= json_decode($requestAPI->getBody()->getContents(),true);
       
    //     // if ($rapid['status']==true) {
    //     //     $user = new User;
    //     //     $user->name=$request->username;
    //     //     $user->save();
    //     //     \Auth::login($user);

    //     // return redirect()->route('dashboard');
    //     // }else{
    //     //     return redirect()->back()->with('error',$rapid['msg']);
    //     // }

       

    // }

    }