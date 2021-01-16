@extends('layouts.app')

@section('content')
    <div class="friend-search-input-div">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">&#8594</span></span>
            </div>
            <input id="search-user" type="text" class="form-control" placeholder="Grow your network"
                   aria-label="Grow your network" aria-describedby="basic-addon1">
        </div>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <div class="logout-wrapper">
            <a style="color: white" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    <div class="px-4 pt-0 pb-4 cover">
        <div class="media align-items-end profile-head">
            <div class="profile mr-3"><img
                    src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80"
                    alt="..." width="130" class="rounded mb-2 img-thumbnail">
            </div>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-4">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h4>
            </div>
        </div>
    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">

        <div id="ex1" class="modal post-modal">
            <textarea id="post-content" style="width: 90%; height: 90%">Thanks for clicking. That felt good.</textarea>
        </br>
            <select name="visibility" id="visibility">
                <option value="1">Public</option>
                <option value="2">Only for friends</option>
            </select>
            <span class="error alert alert-danger d-none">Required</span>
            <a href="#" rel="modal:close" id="close-modal">Close</a>
            <button id="post-store" data-url="{{ route('post.store') }}">Save</button>
        </div>
        <p style="z-index: 9999"><a href="#ex1" rel="modal:open">Add Post</a></p>


        <ul class="list-inline mb-0 relations-and-posts">

            <li id="Approved" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">{{$friends['count']}}</h5>
                <small class="text-muted"> <i class="fas fa-image mr-1"></i>
                    <a href="{{ url('friends')}}"> {{ __('Friends') }}</a></small>
                <input id="friends-count" type="hidden" value="{{$friends['count']}}">
                <input id="friends-ids" type="hidden" value="{{json_encode($friends['friendsIds'], true)}}">
            </li>


            <li id="Rejected" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">{{$rejectedFriendRequests['count']}}</h5>
                <small class="text-muted"> <i class="fas fa-image mr-1"></i><a
                        href="{{ url('rejected-requests')}}"> {{ __('Rejected Friend Requests') }}</a></small>
                <input id="rejected-friend-requests-count" type="hidden" value="{{$rejectedFriendRequests['count']}}">
                <input id="rejected-friend-requests-receivers-ids" type="hidden"
                       value="{{json_encode($rejectedFriendRequests['rejectedFriendRequestsReceiversIds'], true)}}">
            </li>


            <li id="Pending" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">{{$friendRequests['count']}}</h5>
                <small class="text-muted"> <i class="fas fa-image mr-1"></i><a
                        href="{{ url('active-requests')}}"> {{ __('Active Friend Requests') }}</a></small>
                <input id="friend-requests-count" type="hidden" value="{{$friendRequests['count']}}">
                <input id="friend-requests-receivers-ids" type="hidden"
                       value="{{json_encode($friendRequests['friendRequestsReceiversIds'], true)}}">
            </li>


            <li id="posts" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">{{count($posts)}}</h5><small class="text-muted"> <i
                        class="fas fa-user mr-1"></i>Posts</small>
            </li>
        </ul>
    </div>


    <div class="container mt-2">
        <div class="row">
            @if(!empty($posts))
                @foreach($posts as $key => $post)
                    <div class="col-md-4">
                        <div class="single-blog-item">
                            <div class="blog-thumnail">
                                <a href="{{ url('post/'.$post->id)}}"><img src="http://via.placeholder.com/370x275"
                                                                           alt="blog-img"></a>
                            </div>
                            <div class="blog-content">
                                <p>{{$post->post}}</p>
                                <a href="{{ url('post/'.$post->id)}}" class="more-btn">View More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
