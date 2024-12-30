<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TMDBController extends Controller
{
   private $baseUrl = 'https://api.themoviedb.org/3';
   private $imageBaseUrl = 'https://image.tmdb.org/t/p/';
   private $apiKey;
   private $bearerToken;

   public function __construct()
   {
       $this->apiKey = '';
       $this->bearerToken = '';
   }

   public function index()
   {
       try {
           // Get popular movies
           $response = Http::withHeaders([
               'Authorization' => 'Bearer ' . $this->bearerToken,
               'accept' => 'application/json',
           ])->get($this->baseUrl . '/movie/popular');

           $movies = $response->json()['results'];

           // Get additional details for each movie including videos
           foreach ($movies as $key => $movie) {
               $movieDetails = Http::withHeaders([
                   'Authorization' => 'Bearer ' . $this->bearerToken,
                   'accept' => 'application/json',
               ])->get($this->baseUrl . '/movie/' . $movie['id'] . '?append_to_response=videos,credits');

               $movies[$key]['details'] = $movieDetails->json();
           }

           return view('movies.index', [
               'movies' => $movies,
               'imageBaseUrl' => $this->imageBaseUrl
           ]);
       } catch (\Exception $e) {
           return response()->json(['error' => $e->getMessage()], 500);
       }
   }

   public function search(Request $request)
   {
       try {
           $query = $request->get('query', '');
           
           $response = Http::withHeaders([
               'Authorization' => 'Bearer ' . $this->bearerToken,
               'accept' => 'application/json',
           ])->get($this->baseUrl . '/search/movie', [
               'query' => $query
           ]);

           return response()->json($response->json());
       } catch (\Exception $e) {
           return response()->json(['error' => $e->getMessage()], 500);
       }
   }
}
