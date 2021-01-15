<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserLiveSearch extends Controller
{
    public function findUser (Request $request)
    {
        if ($request->ajax()) {
            $data = false;
                $keyword = $request['keyword'];
                if ($keyword != '') {
                    $currentUserId = Auth::id();
                    $data = DB::table('users')
                        ->where('name', 'like', '%' . $keyword . '%')
                        ->where('id', '!=', $currentUserId)
                        ->orWhere('surname', 'like', '%' . $keyword . '%')
                        ->where('id', '!=', $currentUserId)
                        ->orderBy('id', 'desc')
                        ->get();
                }
            return json_encode($data);
        }
    }
}
