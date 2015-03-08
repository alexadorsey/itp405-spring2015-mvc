@extends('layout')

@section('assets')
    <title>Review Dvd</title>
    <link rel="stylesheet" href="{{ asset('css/review.css') }}" type="text/css">
@stop

@section('container')
    <div class="container" id="info">
        
        <h1 id="dvd-header"><span class="glyphicon glyphicon-cd"></span> {{ $dvd->title }}</h1>
        
        <div class="dvd-info">
            <p><strong>Rating:</strong> {{ $dvd->rating_name }}</p>
            <p><strong>Label:</strong> {{ $dvd->label_name }}</p>
        </div>
        <div class="dvd-info">
            <p><strong>Genre:</strong> {{ $dvd->genre_name }}</p>
            <p><strong>Sound:</strong> {{ $dvd->sound_name }}</p>
        </div>
        <div class="dvd-info">
            <p><strong>Release Date:</strong> {{ DATE_FORMAT(new DateTime($dvd->release_date), 'M j, Y') }}</p>
            <p><strong>Format:</strong> {{ $dvd->format_name }}</p>
        </div>
        <div style="clear: both"></div>
        <hr/>
        
        <div id="rotten-tomatoes">
            <h2><u>Rotten Tomatoes</u></h2>
            @if (sizeof($movie) == 0)
                <p>No data for this movie.</p>
            @else
                <img id="poster" src="{{ $movie->posters->original }}">
                <div id="rt-info">
                    <h4>Critics Score:</h4>
                    <p class="score-num" id="critics-num">
                        @if ($movie->ratings->critics_score == -1)
                            --
                        @else
                            {{ $movie->ratings->critics_score }}
                        @endif
                    </p>
                    <h4>Audience Score:</h4>
                    <p class="score-num" id="audience-num">
                        @if ($movie->ratings->audience_score == 0)
                            --
                        @else
                            {{ $movie->ratings->audience_score }}
                        @endif
                    </p>
                </div>
                <div style="clear:both"></div>
                <h4>Runtime: {{ floor($movie->runtime/60) }} hour(s) {{ $movie->runtime%60 }} minutes</h4>
                <h4>Main Cast:</h4>
                @foreach ($movie->abridged_cast as $actor)
                    <p id="actor">{{ $actor->name }}</p>
                @endforeach
            @endif
            
        </div>
        
        <div id="review">
            <h2><u>Your Review</u></h2>
            <form method="post" action="{{ url("dvds/store") }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="dvd_id" value="{{ $dvd_id }}">
                
                <p>Rating:
                    <select name="rating">
                        @for($i = 1; $i<=10; $i++)
                            @if ($i == Request::old('rating'))
                                <option selected="true">
                            @else
                                <option>  
                            @endif
                            {{ $i }}
                            </option>      
                        @endfor
                    </select>
                </p>
                
                <p>Title:
                    <input type="text" name="title" value="{{ Request::old('title') }}">
                </p>
                
                <p>Description:</p>
                    <textarea name="description" rows="5" cols="50">{{ Request::old('description') }}</textarea>
                <br/><br/>
                
                    <!-- Error messages -->
                <div id="messages">
                    @foreach ($errors->all() as $errorMessage)
                        <p style="color:red">*{{ $errorMessage }}</p>
                    @endforeach
                    
                    @if (Session::has('success'))
                        <p>{{ Session::get('success') }}</p>
                    @endif
                    <br/>
                </div>
                
                <button type="submit" class="submit-btn">
                    <a href="#" class="btn btn-lg btn-success">Submit</a>    
                </button>
            </form>
        </div>
        
        <!-- List of reviews -->
        <div id="reviews-list">
            <h2><u>Reviews</u></h2>
            @if (sizeOf($reviews) == 0)
                <p>No reviews yet.</p>
            @else
                @foreach($reviews as $review)
                    <?php $rating = $review->rating ?>
                    @if ($rating >= 7)
                        <span id="rating" style="color:green">{{ $review->rating }}/10</span>
                    @elseif ($rating >= 4)
                        <span id="rating" style="color:#e6b800">{{ $review->rating }}/10</span>
                    @else
                        <span id="rating" style="color:red">{{$review->rating }}/10</span>
                    @endif
                    &nbsp;&nbsp;&nbsp;
                    <span id="rating-title">{{ $review->title }}</span>
                    <br/>
                    <p>{{ $review->description }}</p>
                    <hr/>
                @endforeach
            @endif
        </div>
        <div style="clear:both"></div>
        
    </div>
@stop   