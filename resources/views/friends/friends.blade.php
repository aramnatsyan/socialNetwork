@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="back-to-home-wrapper">
            <button type="button" class="btn btn-light"><a style="color: black" href="{{ route('home') }}">{{ __('Back To Home Page') }}</a>
            </button>
        </div>
    </div>

    <div class="px-4 pt-0 pb-4 cover">
        <div class="media align-items-end profile-head">
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-4">{{__('Friends')}}</h4>
            </div>
        </div>
    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">
        <ul class="list-inline mb-0 relations-and-posts">
        </ul>
    </div>
    @if(!empty($friends))
        <div class="container pt-3">
            <div class="row">
                @foreach($friends as $key => $friend)
                    <div class="col-md-8 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center"><span style="background-image: url(https://bootdey.com/img/Content/avatar/avatar6.png)" class="avatar avatar-xl mr-3"></span>
                                    <div class="media-body overflow-hidden">
                                        <h5 class="card-text mb-0">{{ $friend[0]->name }} {{ $friend[0]->surname }}</h5>
                                    </div>
                                </div><a href="{{ url('user/'.$friend[0]->id)}}" class="tile-link"></a>
                            </div>
                        </div>
                        <button data-id="{{$friend[0]->id}}" type="button" class= "btn btn-danger ml-2 delete-friend"> Delete</button>
                    </div>
                @endforeach

            </div>
        </div>
    @else
        <div style="text-align: center">
            <h5 class="font-weight-bold mb-0 d-block">No Friends</h5>
        </div>
    @endif

@endsection
