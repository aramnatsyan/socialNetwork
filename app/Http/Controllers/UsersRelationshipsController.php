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

            $deleting = DB::table('relationships')
                ->where('sender_id', '=', $currentUserId)->where('receiver_id', '=', $receiverId)
                ->orWhere('sender_id', '=', $receiverId)->where('receiver_id', '=', $currentUserId)
                ->delete();


            if ($deleting) {
                $deleted  = true;
            }
            return json_encode($deleted);
        }
    }

    public function getUsersWithRelations(Request $request)
    {
        if (!empty($request['action']) && !empty($request['ids'])) {
            $action = $request['action'];
            $ids = json_decode($request['ids']);

            $response = [];
            $data = '';

            if ($action == 'Approved') {
                $data = $this->getFriends($ids);
            }

            if ($action == 'Pending') {
                $data = $this->getFriendRequestPendedUsers($ids);
            }

            if ($action == 'Rejected') {
                $data = $this->getRejectedUsers($ids);
            }

            $response = [
                'massage' =>$action,
                'data' => $data
            ];
            return route('friends', ['data' => $data]);
//            return json_encode($response);
        }
    }

    public function getFriends () {
        $currentUserId = Auth::id();
        $friendRequestStatusesArray = Config::get('constants.friend_request_status');

        $friendsIds = DB::table('relationships')->where(function ($query){
            $currentUserId = Auth::id();
            $friendRequestStatusesArray = Config::get('constants.friend_request_status');
            $query->where('receiver_id', '=', $currentUserId)->where('status', '=', $friendRequestStatusesArray['Approved']);
        })
            ->orWhere(function ($query){
                $currentUserId = Auth::id();
                $friendRequestStatusesArray = Config::get('constants.friend_request_status');
                $query->where('sender_id', '=', $currentUserId)->where('status', '=', $friendRequestStatusesArray['Approved']);
            })->get();

        $friends = [];
        foreach ($friendsIds as $friend => $data) {

            if ($data->sender_id == $currentUserId) {
                $friend =  DB::table('users')->where('id', '=' , $data->receiver_id)->get();
            }
            else {
                $friend =  DB::table('users')->where('id', '=' , $data->sender_id)->get();
            }

           array_push($friends, $friend);
        }
        return view('friends.friends')->with(['friends' => $friends]);
    }

    public function getFriendRequestPendedUsers (){
        $currentUserId = Auth::id();
        $friendRequestStatusesArray = Config::get('constants.friend_request_status');
        $friendRequests = [];
        $friendsIds = DB::table('relationships')->where('receiver_id', '=', $currentUserId)->where('status', '=', $friendRequestStatusesArray['Pending'])->get();

        foreach ($friendsIds as $friend => $data) {
            $friend =  DB::table('users')->where('id', '=' , $data->sender_id)->get();
            array_push($friendRequests, $friend);
        }
        return view('friend-requests.friendRequests')->with(['friendRequests' => $friendRequests]);
    }

    public function getRejectedUsers (){
        $currentUserId = Auth::id();
        $friendRequestStatusesArray = Config::get('constants.friend_request_status');
        $rejectedUsers = [];
        $usersIds = DB::table('relationships')->where('receiver_id', '=', $currentUserId)->where('status', '=', $friendRequestStatusesArray['Rejected'])->get();

        foreach ($usersIds as $friend => $data) {
            $user =  DB::table('users')->where('id', '=' , $data->sender_id)->get();
            array_push($rejectedUsers, $user);
        }
        return view('rejected-friend-requests.rejected')->with(['friendRequests' => $rejectedUsers]);
    }

    public function rejectRequest (Request $request){

        if (!empty($request['userId'])) {
            $rejected = false ;
            $senderId = $request['userId'];
            $currentUserId = Auth::id();
            $friendRequestStatusesArray = Config::get('constants.friend_request_status');
            $rejecting = DB::table('relationships')
                ->where('sender_id', '=', $senderId)->where('receiver_id', '=', $currentUserId)
                ->update(['status' => $friendRequestStatusesArray['Rejected']]);

            if ($rejecting) {
                $rejected  = true;
            }
            return json_encode($rejected);
        }
    }
}
