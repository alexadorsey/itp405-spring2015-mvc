@extends('layout')

@section('assets')
    <title>{{ $genre_name }} Dvds</title>
    <link rel="stylesheet" href="{{ asset('css/results.css') }}" type="text/css">
@stop

@section('container')
    <div class="container">
        <h1>Genre: {{ $genre_name }}</h1>
        <table border="1" align="center">
            <col width="400">
            <col width="100">
            <col width="200">
            <col width="300">
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
            </tr>
            @foreach($dvds as $dvd)
            <tr>
                <td>{{ $dvd->title }}</td>
                <td>{{ $dvd->rating->rating_name }}</td>
                <td>{{ $dvd->genre->genre_name }}</td>
                <td>{{ $dvd->label->label_name }}</td>
            </tr>
            @endforeach
        </table>  
    </div>
@stop