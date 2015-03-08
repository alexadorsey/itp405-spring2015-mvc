<?php namespace App\Services;

use App\Models\Dvd;
use Illuminate\Support\Facades\Cache;

class RottenTomatoes {
    
    // Takes a dvd title and retrives the relevant information from Rotten Tomatoes
    public static function search($dvd_title) {
        
        // Check if rotten tomatoes id is already in the cache
        if (Cache::has("rotten-tomatoes-$dvd_title")) {
            $jsonString = Cache::get("rotten-tomatoes-$dvd_title");
        } else {
            
            // Replace spaces with + sign
            $url_title = $journalName = preg_replace('/\s+/', '+', $dvd_title);
            
            $api_key = "b3a8hz3ut37jjcc8v4xqyst8";
            $url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=$api_key&q=$url_title";
            $jsonString = file_get_contents($url);
            
            // Put the rotten tomatoes id in the cache for 60 minutes
            Cache::put("rotten-tomatoes-$dvd_title", $jsonString, 60);
        }
        
        $rottenTomatoesData = json_decode($jsonString);
        
        // See if there's a match in the rotten tomamtoes database
        $movie_match = [];
        
        foreach($rottenTomatoesData->movies as $movie) {
            if (strpos($dvd_title, strtolower($movie->title)) !== false) {
                $movie_match = $movie;
                break;
            }
        }
        
        return $movie_match;
    }
    
}

?>