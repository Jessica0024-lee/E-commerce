@extends('layouts.auth')
@section('content')
<div class="container mt-5">

    <h2>Announcement</h2>
   
    <p>We're excited to announce that we'll be hosting live streams on our social media platforms, including some special events! We'd love your support there.
The featured video is either our latest or most popular live stream. We'll also share more live streams here to keep you entertained and engaged. Come join us and be a part of the fun! See you there~</p>
    <ul>
        @foreach($liveStreams as $liveStream)

            <h2><li>{{ $liveStream->name }} - </h2>
            <p><li>{{ $liveStream->description }} </p>

                <!-- Embedding the live stream video -->
                <div class="embed-responsive embed-responsive-16by9">
                <div class="embed-responsive-item" allowfullscreen>   {!! $liveStream->embed_link !!}                    
            </iframe>
                              
                            </div>
    
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
