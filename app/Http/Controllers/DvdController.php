<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;
use App\Http\Controllers\View;

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
    
    public function review($id) {
        $dvd = (new DvdQuery())->getAllInfo($id);
        $dvds = (new DvdQuery())->getDvds();
        $reviews = (new DvdQuery())->getReviews($id);
        return view('review', [
            'dvd' => $dvd[0],
            'dvds' => $dvds,
            'dvd_id' => $id,
            'reviews' => $reviews
        ]);
    }
    
    public function storeDvd(Request $request) {
        $validation = DvdQuery::validate($request->all());
                
        if ($validation->passes()) {
            DvdQuery::create([
                'rating' => $request->input('rating'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'dvd_id' => $request->input('dvd_id')
            ]);
            return redirect('/dvds/' . $request->input('dvd_id'))->with('success', 'Review successfully added!');
        } else {
            return redirect('/dvds/' . $request->input('dvd_id'))
                ->withInput()
                ->withErrors($validation);
        }
    }
}


?>