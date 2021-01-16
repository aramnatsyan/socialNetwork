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
                <small class="text-muted"> <i class="fas fa-image mr-1"></i><a href="{{ url('rejected-requests')}}"> {{ __('Rejected Friend Requests') }}</a></small>
                <input id="rejected-friend-requests-count" type="hidden" value="{{$rejectedFriendRequests['count']}}">
                <input id="rejected-friend-requests-receivers-ids" type="hidden" value="{{json_encode($rejectedFriendRequests['rejectedFriendRequestsReceiversIds'], true)}}">
            </li>


            <li id="Pending" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">{{$friendRequests['count']}}</h5>
                <small class="text-muted"> <i class="fas fa-image mr-1"></i><a href="{{ url('active-requests')}}"> {{ __('Active Friend Requests') }}</a></small>
                <input id="friend-requests-count" type="hidden" value="{{$friendRequests['count']}}">
                <input id="friend-requests-receivers-ids" type="hidden" value="{{json_encode($friendRequests['friendRequestsReceiversIds'], true)}}">
            </li>


            <li id="posts" class="list-inline-item relations-data">
                <h5 class="font-weight-bold mb-0 d-block">745</h5><small class="text-muted"> <i
                        class="fas fa-user mr-1"></i>Posts</small>
            </li>
        </ul>
    </div>

    <div class="py-4 px-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0">Posts</h5>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-2 pr-lg-1"><img
                    src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    alt="" class="img-fluid rounded shadow-sm"></div>
            <div class="col-lg-6 mb-2 pl-lg-1"><img
                    src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    alt="" class="img-fluid rounded shadow-sm"></div>
            <div class="col-lg-6 pr-lg-1 mb-2"><img
                    src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                    alt="" class="img-fluid rounded shadow-sm"></div>
            <div class="col-lg-6 pl-lg-1"><img
                    src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    alt="" class="img-fluid rounded shadow-sm"></div>
        </div>
    </div>
@endsection
