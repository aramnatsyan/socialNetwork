@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="back-to-home-wrapper">
            <button type="button" class="btn btn-light"><a style="color: black" href="{{ route('home') }}">{{ __('Back To Home Page') }}</a>
            </button>
        </div>
    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">

    </div>


    <div class="container mt-2">
        <div class="row">
            @if(!empty($post))
                <div class="col-md-12 single-post-wrapper">
                    <div class="single-blog-item" style="text-align: center;padding: 10px">
                        <div class="blog-thumnail">
                            <a href="{{ url('post/'.$post->id)}}"><img src="http://via.placeholder.com/370x275" alt="blog-img" class="single-post-image"></a>
                        </div>
                        <div class="blog-content">
                            <p>{{$post->post}}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
