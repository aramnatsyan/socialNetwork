<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function getUserProfile(Request $request, $id)
    {
        if ($request) {
            $user = false;
            if ($id != '') {
                $user = DB::table('users')->where('id', '=', $id)->get();
            }

            return view('user.profile')->with(['user' => $user[0]]);
        }
    }
}
