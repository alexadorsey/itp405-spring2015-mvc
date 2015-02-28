@extends('layout')

@section('assets')
    <title>Search Dvds</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}" type="text/css">
@stop

@section('container')
    <div class="container">
        <h1>Search for DVDs from our database</h1>
        <div class="box">
            <div id="genre-search">
                <h3>Choose a Genre</h3>
                @foreach ($genres as $genre)
                    <p><a href="/genres/{{ strtolower($genre->genre_name) }}/dvds">{{ $genre->genre_name}} </a></p>
                @endforeach
            </div>
            <div id="title-search">
                <h3>Search by Title</h3>
                <form method="get" action="/dvds">
                    <p>Title: <input type="text" name="title"></p>
                    <p>Genre:
                        <select name="genre">
                            <option value="All" selected>All</option>
                            @foreach($genres as $genre)
                                <option>
                                    {{ $genre->genre_name }}
                                </option>
                            @endforeach
                        </select>
                    </p>
                    <p>Rating:
                        <select name="rating" style="width: 180px">
                            <option value="All" selected>All</option>
                            @foreach($ratings as $rating)
                                <option>
                                    {{ $rating->rating_name }}
                                </option>
                            @endforeach
                        </select>
                    </p>
                    <br/>
                    <button type="submit">
                        <a href="#" class="btn btn-lg btn-danger">Search</a>    
                    </button>
                    <br/>
                </form>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
@stop