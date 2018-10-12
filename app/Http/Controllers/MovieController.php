<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MoviesCollection;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
    	return new MoviesCollection(Movie::orderBy('up_votes','DESC')->get());
    }

    public function store(Request $request){
    	$movie = new Movie;
    	$movie->movie_name = $request->name;
    	$movie->save();
    	return new MovieResource($movie);
    }

    public function add($id){
    	$movie = Movie::findOrFail($id);
		$movie->up_votes = $movie->up_votes + 1;
		$movie->save();
		return new MovieResource($movie);
    }

    public function subtract($id){
    	$movie = Movie::findOrFail($id);
		$movie->down_votes = $movie->down_votes + 1;
		$movie->save();
		return new MovieResource($movie);
    }
}
