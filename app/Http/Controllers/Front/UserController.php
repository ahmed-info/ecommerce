<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Front\AuthenticatesUsers;
use stdClass;

class UserController extends Controller
{
    public function showUserName(){
        return 'Ahmed Razzaq';
    }

    public function getIndex(){
        /*
            $obj = new stdClass();
            $obj-> name = 'Hamoodee';
            $obj-> id = 6;
            $obj-> gender = 'male'; */
            //return view('welcome', compact( 'obj'));

            /*
            $data =[];
            $data['id'] =1;
            $data['name'] = 'Developer Ahmed Razzaq from controller';
            return view('welcome', $data);
            */
            //return view('welcome')->with('name','ahmed yahya');

            $data= ['ahmed', 'ghofran'];

            //return view('welcome', compact('data'));
            //or
            return view('welcome')->with('data', $data);
        
            
  
    }
}
