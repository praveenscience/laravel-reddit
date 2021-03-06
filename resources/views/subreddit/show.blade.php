@extends('layouts/default')

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.upvote.css') }}">
    <script src="{{ URL::asset('assets/js/jquery.upvote.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.topic').upvote();

            $('.topic').on('click', function (e) {
                e.preventDefault();
                var data = {value: $('.vote').data('value'), post_id: $(this).data('post')};

                var clicked_button = $(this).children();

                if($(clicked_button).hasClass('downvote-on')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: 'http://localhost/laravel-5/public/votes',
                        dataType: 'JSON',
                        data: data
                    });
                } else if ($(clicked_button).hasClass('upvote-on')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: 'http://localhost/laravel-5/public/votes',
                        dataType: 'JSON',
                        data: data
                    });
                }
            });
        });
    </script>

    <h1>Subreddit: {{ $subreddit->name }}</h1>

    @foreach($posts as $post)
        <div class="row">
            <div class="span8">
                <div class="row">
                    <div class="col-md-12">
                        <h4><strong><a href="#"></a></strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <form action=""
                        {!! Form::open(['url' => 'votes', 'class' => 'votes']) !!}
                            <div class="upvote topic" data-post="{{ $post->id }}">
                                <a class="upvote vote" data-value="1"></a>
                                <span class="count">0</span>
                                <a class="downvote vote" data-value="-1"></a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-1">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/70x70" alt="">
                        </a>
                    </div>
                    <div class="col-md-10">
                        <p>
                            <a href="#">{{ $post->title }}</a>
                        </p>
                        <p style="color: darkgrey; font-size: 12px;">
                            <i class="glyphicon glyphicon-user" style="padding-right: 5px;"></i>submitted by <a href="#">{{ $post->user->name }}</a>
                             <i class="glyphicon glyphicon-calendar" style="padding-left: 15px;"></i> {{ $post->created_at->diffForHumans() }}
                             <i class="glyphicon glyphicon-comment" style="padding-left: 15px;"></i> <a href="#">3 Comments</a>
                             <i class="glyphicon glyphicon-tags" style="padding-left: 15px;"></i> Tags : <a href="#"><span class="label label-info">Snipp</span></a>
                            <a href="#"><span class="label label-info">Bootstrap</span></a>
                            <a href="#"><span class="label label-info">UI</span></a>
                            <a href="#"><span class="label label-info">growth</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@stop