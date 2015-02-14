<?php namespace App\Models;
use DB;

class DvdQuery {
    
    public function getGenres() {
        $query = DB::table('genres')->orderBy('genre_name', 'asc');
        return $query->get();
    }
    
    public function getRatings() {
        $query = DB::table('ratings');
        return $query->get();
    }
    
    public function search($title, $genre, $rating) {
        $query = DB::table('dvds')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');
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
}

?>