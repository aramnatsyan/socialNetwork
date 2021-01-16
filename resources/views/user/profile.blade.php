@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="back-to-home-wrapper">
            <button type="button" class="btn btn-light"><a style="color: black"
                                                           href="{{ route('home') }}">{{ __('Back To Home Page') }}</a>
            </button>
        </div>
    </div>

    <div class="px-4 pt-0 pb-4 cover">
        <div class="media align-items-end profile-head">
            <div class="profile mr-3"><img
                    src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80"
                    alt="..." width="130" class="rounded mb-2 img-thumbnail">
            </div>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-4">{{ $user->name }} {{ $user->surname }}</h4>
            </div>
        </div>
        <div class="send-friend-request-wrapper">
            <div class="input-group w-100">
                <div class="input-group-prepend w-100">
                    @if($relationship === 'Pending')
                        @php
                            $class = 'btn btn-warning';
                            $actionButtonSecondClass = 'btn btn-danger';
                            $actionName = 'Cancel';
                        @endphp
                        <div id="relationship-pending" class= "w-100"> {{$relationship}} </div>
                        <button id="cancel-fr"  type="button" class= "{{$actionButtonSecondClass}} ml-2 relationship-action"> {{$actionName}} </button>

                    @elseif($relationship === 'Approved')
                        @php
                            $class = 'btn btn-success';
                            $actionButtonSecondClass = 'btn btn-danger';
                            $actionName = 'Delete';
                        @endphp
                        <div id="relationship-approved" class= "w-100"> {{$relationship}} </div>
                        <button id="delete"  type="button" class= "{{$actionButtonSecondClass}} ml-2 relationship-action"> {{$actionName}} </button>

                    @elseif($relationship === 'Rejected')
                        <div id="relationship-rejected" class= "w-100"> {{$relationship}} </div>
                    @else
                        <button id="add-to-friends" type="button" class= "btn btn-info btn-lg w-100 relationship-action"> Add To Friends</button>
                    @endif
                </div>
            </div>
            <input id="profile-user-id" type="hidden" value="{{ $user->id }}">
        </div>
    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">{{ $friendsCount }}</h5><small class="text-muted"> <i
                        class="fas fa-image mr-1"></i>Friends</small>
            </li>
            <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">{{ $postCount }}</h5><small class="text-muted"> <i
                        class="fas fa-user mr-1"></i>Posts</small>
            </li>
        </ul>
    </div>

    <div class="py-4 px-4">
        <div class=" mb-3">
            <h5 class="mb-0">Posts</h5>
            @if ($relationship != 'Approved')
                <p class="alert alert-info">Dear {{$currentUserNameForInfo}} as you and {{$user->name}} are not friends, You can see only public posts.</p>
            @endif
        </div>
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
    </div>
@endsection
