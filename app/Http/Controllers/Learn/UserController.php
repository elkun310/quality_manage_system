<?php

namespace App\Http\Controllers\Learn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
//        $this->middleware(function ($request, $next) {
////            if (!admin()->check()) {
////                return redirect(route(LOGIN_INDEX));
////            }
//            return $next($request);
//        });


//        $this->middleware('auth');
//
//        $this->middleware('log')->only('index');
//
//        $this->middleware('subscribed')->except('store');

//        $this->middleware('user_block')->only(['login','register']);
    }


    public function index($id)
    {
//        $users = DB::table('users')->where('name', 'ha')->get();
//        $users = DB::table('users')->where('name', 'ha')->value('email');
//        $users = DB::table('users')->pluck('email', 'name');
//        $users = DB::table('users')->select('name', 'email')->get();
//        $users = DB::table('users')->distinct()->get();
//        DB::table('documents')->orderBy('id')->chunk(100, function ($documents) {
//            foreach ($documents as $document) {
//                echo $document->name_company. "<br>";
//            }
//        });

        dd(DB::table('users')->distinct()->get());
//        dd($users);
        echo "id : ". $id;
    }
}
