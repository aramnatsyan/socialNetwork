<?php

namespace App\Http\Controllers;

use App\Models\UsersRelationships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersRelationshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        if (!empty($request['receiverId'])) {
            $inserted = false ;
            $receiverId = $request['receiverId'];
            $currentUserId = Auth::id();
            $friendRequestStatusesArray = Config::get('constants.friend_request_status');
            $relationStatus = $friendRequestStatusesArray['Pending'];
            $values = array('sender_id' => $currentUserId,'receiver_id' => $receiverId, 'status' => $relationStatus);
            $inserting = DB::table('relationships')->insert($values);
            if ($inserting) {
                $inserted  = true;
            }
            return json_encode($inserted);
        }
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
     * @param  \App\Models\UsersRelationships  $usersRelationships
     * @return \Illuminate\Http\Response
     */
    public function show(UsersRelationships $usersRelationships)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersRelationships  $usersRelationships
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersRelationships $usersRelationships)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsersRelationships  $usersRelationships
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersRelationships $usersRelationships)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersRelationships  $usersRelationships
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersRelationships $usersRelationships)
    {

    }

    public function deleteRelation(Request $request)
    {
        if (!empty($request['receiverId'])) {
            $deleted = false ;
            $receiverId = $request['receiverId'];
            $currentUserId = Auth::id();
            $deleting = DB::table('relationships')->where('sender_id', '=', $currentUserId)->where('receiver_id', '=', $receiverId)->delete();
            if ($deleting) {
                $deleted  = true;
            }
            return json_encode($deleted);
        }
    }
}
