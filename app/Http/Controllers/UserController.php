<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        return view('home');
    }

    public function getUserProfile (Request $request, $id)
    {
        if ($request) {
            $friendRequestStatusesArray = Config::get('constants.friend_request_status');
            $currentUserId = Auth::id();
            $relationshipStatus = '';
            $userData = '';
            if ($id != '') {
                $user = DB::table('users')->where('id', '=', $id)->get();
                if ($user) {
                    $userData = json_decode($user)[0];
                    $foundUserId = $userData->id;
                    $relationship = DB::table('relationships')->where('sender_id', '=', $currentUserId)->where('receiver_id', '=', $foundUserId)->get();
                    if (!empty(json_decode($relationship))) {
                        $relationship = json_decode($relationship)[0];
                        $relationshipStatusColumn = $relationship->status;
                        if ($relationshipStatusColumn) {
                            $relationshipStatus = array_search($relationshipStatusColumn, $friendRequestStatusesArray);
                        }
                    }
                }
            }

            return view('user.profile')->with(['user' => $userData, 'relationship' => $relationshipStatus]);
        }
    }
}
