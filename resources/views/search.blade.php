@extends('layout')

@section('assets')
    <title>Search Dvds</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}" type="text/css">
@stop

@section('container')
    <div class="container">
        <div class="box">
            <h1>Search for DVDs from our database</h1>
            <form method="get" action="/dvds">
                <span>Title: <input type="text" name="title"></span>
                <span>Genre:
                    <select name="genre">
                        <option value="All" selected>All</option>
                        @foreach($genres as $genre)
                            <option>
                                {{ $genre->genre_name }}
                            </option>
                        @endforeach
                    </select>
                </span>
                <span>Rating:
                    <select name="rating" style="width: 180px">
                        <option value="All" selected>All</option>
                        @foreach($ratings as $rating)
                            <option>
                                {{ $rating->rating_name }}
                            </option>
                        @endforeach
                    </select>
                </span>
                <br/>
                <br/>
                <button type="submit">
                    <a href="#" class="btn btn-lg btn-danger">Search</a>    
                </button>
                <br/>
            </form>
            <hr/>
        </div>
    </div>
@stop