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
                <h5 class="font-weight-bold mb-0 d-block">215</h5><small class="text-muted"> <i
                        class="fas fa-image mr-1"></i>Friends</small>
            </li>
            <li class="list-inline-item">
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
    </div>
@endsection
