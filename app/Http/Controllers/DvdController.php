<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;

class DvdController extends Controller {
    
    public function search() {
        $genres = (new DvdQuery())->getGenres();
        $ratings = (new DvdQuery())->getRatings();
        
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }
    
    public function results(Request $request) {
        $title = $request->input('title');
        $genre = $request->input('genre');
        $rating = $request->input('rating');
        $dvds = (new DvdQuery())->search($title, $genre, $rating);
        
        return view('results', [
            'title' => $title,
            'genre' => $genre,
            'rating' =>$rating,
            'dvds' => $dvds
        ]);
    }
}


?>