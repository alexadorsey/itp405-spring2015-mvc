<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DvdQuery;
use App\Http\Controllers\View;

use App\Models\Dvd;
use App\Models\Label;
use App\Models\Sound;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Format;

class DvdController extends Controller {
    
    // DVD Results Page    
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

    
    // DVD Review Page
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