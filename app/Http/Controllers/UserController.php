<?php

namespace App\Http\Controllers;

use App\Models\Posts;
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
        $currentUserId = Auth::id();
        $friendRequestStatusesArray = Config::get('constants.friend_request_status');

        $friendsCount = 0;
        $friendRequestsCount = 0;
        $rejectedFriendRequestsCount = 0;


        $posts = DB::table('posts')->where('author_id', '=', $currentUserId)->get();


        $friends = [
            'count' => 0,
            'friendsIds' => []
        ];

        $friendRequests = [
            'count' => 0,
            'friendRequestsReceiversIds' => []
        ];

        $rejectedFriendRequests = [
            'count' => 0,
            'rejectedFriendRequestsReceiversIds' => []
        ];

        $relationships = DB::table('relationships')->where('receiver_id', '=', $currentUserId)->orWhere('sender_id', '=', $currentUserId)->get();
        foreach ($relationships as $key => $relation) {
            // get friends
            if ($relation->status == $friendRequestStatusesArray['Approved']) {

                $friendsCount = $friendsCount + 1;
                array_push($friends['friendsIds'], $relation->sender_id);
            }
            $friends['count'] = $friendsCount;

            // get friend requests
            if ($relation->status == $friendRequestStatusesArray['Pending']) {
                $friendRequestsCount = $friendRequestsCount + 1;
                array_push($friendRequests['friendRequestsReceiversIds'], $relation->sender_id);
            }
            $friendRequests['count'] = $friendRequestsCount;

            // get rejected friend requests
            if ($relation->status == $friendRequestStatusesArray['Rejected']) {
                $rejectedFriendRequestsCount = $rejectedFriendRequestsCount + 1;
                array_push($rejectedFriendRequests['rejectedFriendRequestsReceiversIds'], $relation->sender_id);
            }
            $rejectedFriendRequests['count'] = $rejectedFriendRequestsCount;
        }

        return view('home')->with(['friends' => $friends, 'friendRequests' => $friendRequests, 'rejectedFriendRequests' => $rejectedFriendRequests, 'posts' => $posts]);
    }

    public function getUserProfile (Request $request, $id)
    {
        if ($request) {
            $friendRequestStatusesArray = Config::get('constants.friend_request_status');
            $postsStatus = Config::get('constants.posts_visibility');
            $currentUserNameForInfo = Auth::user()->name;
            $relationshipStatus = '';
            $userData = '';
            if ($id != '') {
                $user = DB::table('users')->where('id', '=', $id)->get();
                if ($user) {
                    $userData = json_decode($user)[0];
                    $foundUserId = $userData->id;
                    $relationship = DB::table('relationships')->orwhere('sender_id', '=', $foundUserId)->orwhere('receiver_id', '=', $foundUserId)->get();

                    if (!empty(json_decode($relationship))) {
                        $relationship = json_decode($relationship)[0];
                        $relationshipStatusColumn = $relationship->status;
                        if ($relationshipStatusColumn) {
                            $relationshipStatus = array_search($relationshipStatusColumn, $friendRequestStatusesArray);
                        }
                    }

                    if ($relationshipStatus == 'Approved') {
                        $posts = Posts::where('author_id', $foundUserId)->paginate(12);
                    } else {
                        $posts = Posts::where(['status' => $postsStatus['public'], 'author_id' => $foundUserId])->paginate(12);
                    }
                    $postCount = Posts::where(['author_id' => $foundUserId])->get()->count();
                    $friendsCount =  DB::table('relationships')->orwhere('sender_id', '=', $foundUserId)->orwhere('receiver_id', '=', $foundUserId)->where('status', '=', $friendRequestStatusesArray['Approved'])->get()->count();
                }
            }
            return view('user.profile')->with(['currentUserNameForInfo' => $currentUserNameForInfo,'user' => $userData, 'relationship' => $relationshipStatus, 'posts' => $posts, 'postCount' => $postCount, 'friendsCount' => $friendsCount, 'friendRequestSatus' => $friendRequestStatusesArray]);
        }
    }
}
