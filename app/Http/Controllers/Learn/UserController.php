<?php

namespace App\Http\Controllers\Learn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //closure middleware
        $this->middleware(function ($request, $next) {
//            if (!admin()->check()) {
//                return redirect(route(LOGIN_INDEX));
//            }
            return $next($request);
        });


//        $this->middleware('auth');
//
//        $this->middleware('log')->only('index');
//
//        $this->middleware('subscribed')->except('store');

//        $this->middleware('user_block')->only(['login','register']);
    }


    public function index($id)
    {
        echo "id : ". $id;
    }
}
