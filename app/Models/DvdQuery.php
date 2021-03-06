<?php namespace App\Models;
use DB;
use Validator;

class DvdQuery {
    
    public function getGenres() {
        $query = DB::table('genres')->orderBy('genre_name', 'asc');
        return $query->get();
    }
    
    public function getRatings() {
        $query = DB::table('ratings');
        return $query->get();
    }
    
    public function getDvds() {
        $query = DB::table('dvds')
            ->orderBy('title', 'asc');
        return $query->get();
    }
    
    public function search($title, $genre, $rating) {
        $query = DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->select('*', 'dvds.id');
        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if ($genre && $genre != 'All') {
            $query->where('genre_name', '=', $genre);
        }
        if ($rating && $rating != 'All') {
            $query->where('rating_name', '=', $rating);
        }
        $query->orderBy('title', 'asc');
        return $query->get();
    }
    
    public function getAllInfo($id) {
        $query = DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->where('dvds.id', '=', $id);
        return $query->get();
    }
    
    public function getReviews($id) {
        $query = DB::table('reviews')
            ->where('dvd_id', '=', $id)
            ->orderBy('id', 'desc');
        return $query->get();
    }
    
    public static function validate($input) {
        return Validator::make($input, [
            'rating' => 'required|integer|between:1,10',
            'title' => 'required|min:5',
            'description' => 'required|min:20',
        ]);
    }
    
    public static function create($data) {
        return DB::table('reviews')->insert($data);
    }
    
}

?>