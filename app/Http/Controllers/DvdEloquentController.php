<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\View;

use App\Models\Dvd;
use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;

class DvdEloquentController extends Controller {
    
    // DVD Search Page
    public function search() {
        $genres = Genre::all();
        $ratings = Rating::all();

        foreach ($genres as $genre) {
            $replace = array('\s', '/');
            $genre->genre_name = str_replace($replace, '-', $genre->genre_name);
        }
        
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }
    
    // DVD Creation Page
    public function create() {
        $labels = Label::all();
        $sounds = Sound::all();
        $genres = Genre::all();
        $ratings = Rating::all();
        $formats = Format::all();
        return view('create', [
            'labels' => $labels,
            'sounds' => $sounds,
            'genres' => $genres,
            'ratings' => $ratings,
            'formats' => $formats
        ]);
    }
    
    public function createNew(Request $request) {
        $dvd = new Dvd;
        $dvd->title = $request->title;
        $dvd->label_id = $request->label;
        $dvd->sound_id = $request->sound;
        $dvd->genre_id = $request->genre;
        $dvd->rating_id = $request->rating;
        $dvd->format_id = $request->format;
        $dvd->release_date = Date("Y/m/d H:i:s");
        $dvd->save();
        return redirect('/dvds/create')->with('success', 'Dvd successfully added!');
    }
    
    // DVD Genres Page
    public function genres($genre_name) {
        $genre_name = ucfirst($genre_name);
        if ($genre_name == "Children's-family") {
            $genre_name = "Children's/Family";
        }
        
        $dvds = Dvd::with('genre', 'rating', 'label')
        ->whereHas('genre', function($query) use($genre_name) {
            $query->where('genre_name', '=', $genre_name);
        })
        ->get();

        return view('genres', [
            'dvds' => $dvds,
            'genre_name' => $genre_name
        ]);
    }
    
}