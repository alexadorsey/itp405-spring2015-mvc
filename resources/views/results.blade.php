@extends('layout')

@section('assets')
    <title>Dvd Search Results</title>
    <link rel="stylesheet" href="{{ asset('css/results.css') }}" type="text/css">
@stop

@section('container')
    <div class="container">
        @if ($genre || $rating)
            <br/>
            <h3>Search results for
            @if ($title)
                Title: '{{ $title }}, '
            @endif
            Genre: '{{ $genre }}', Rating: '{{ $rating }}'</h3>
        @endif
        <table border="1">
            <col width="400">
            <col width="100">
            <col width="200">
            <col width="200">
            <col width="150">
            <col width="150">
            <col width="200">
            <col width="200">
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
                <th>Release Date</th>
                <th>Review</th>
            </tr>
        @foreach($dvds as $dvd)
            <tr>
                <td>{{ $dvd->title }}</td>
                <td>{{ $dvd->rating_name }}</td>
                <td>{{ $dvd->genre_name }}</td>
                <td>{{ $dvd->label_name }}</td>
                <td>{{ $dvd->sound_name }}</td>
                <td>{{ $dvd->format_name }}</td>
                <td>{{ DATE_FORMAT(new DateTime($dvd->release_date), 'M j, Y') }}</td>
                <td><a href="/dvds/{{ $dvd->id }}">Review</a></td>
            </tr>
        @endforeach
        </table>
     </div>  
@stop