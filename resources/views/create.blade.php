@extends('layout')

@section('assets')
    <title>Create a DVD</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}" type="text/css">
@stop

@section('container')
    <div class="container">
        <h1><span class="glyphicon glyphicon-cd"></span> Add a Dvd to Our Database</h1>
        <form method="post" action="/dvds/createNew">
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
            <p><strong>Title: &nbsp;&nbsp;&nbsp;</strong><input name="title" type="text" required></p>
            <p><strong>Label: &nbsp;&nbsp;&nbsp;</strong><select name="label">
                <option value="" disabled selected>Select Label</option>
                @foreach ($labels as $label)
                    <option value="{{ $label->id }}">{{ $label->label_name }}</option>
                @endforeach
            </select>
            </p>
                
            <p><strong>Sound: &nbsp;&nbsp;&nbsp;</strong><select name="sound">
                <option value="" disabled selected required>Select Sound</option>
                @foreach ($sounds as $sound)
                    <option value="{{ $sound->id }}">{{ $sound->sound_name }}</option>
                @endforeach
            </select>
            </p>
    
            <p><strong>Genre: &nbsp;&nbsp;&nbsp;</strong><select name="genre">
                <option value="" disabled selected required>Select Genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
            </p>
                
            <p><strong>Rating: &nbsp;&nbsp;&nbsp;</strong><select name="rating">
                <option value="" disabled selected required>Select Rating</option>
                @foreach ($ratings as $rating)
                    <option value="{{ $rating->id }}">{{ $rating->rating_name }}</option>
                @endforeach
            </select>
            </p>
                
            <p><strong>Format: &nbsp;&nbsp;&nbsp;</strong><select name="format">
                <option value="" disabled selected required>Select Format</option>
                @foreach ($formats as $format)
                    <option value="{{ $format->id }}">{{ $format->format_name }}</option>
                @endforeach
            </select>
            </p>
            <button type="submit" id="submit-btn">
                <a href="#" class="btn btn-lg btn-info">Add Dvd</a>    
            </button>
        </form>
            
        <!-- Success message -->
        <div id="messages">           
            @if (Session::has('success'))
                <br/>
                <p style="color: #5CD65C">{{ Session::get('success') }}</p>
                <br/>
            @endif
        </div>
    </div>
@stop