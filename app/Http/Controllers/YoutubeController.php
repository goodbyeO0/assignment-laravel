<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_YouTube;

class YouTubeController extends Controller
{
    private $youtube;
    
    public function __construct()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $this->youtube = new Google_Service_YouTube($client);
    }

    public function index()
    {
        try {
            // Search for videos
            $searchResponse = $this->youtube->search->listSearch('snippet', [
                'q' => 'kai cenat',
                'maxResults' => 10,
                'type' => 'video',
                'part' => 'snippet'
            ]);

            $videos = [];
            foreach ($searchResponse->getItems() as $item) {
                $videos[] = [
                    'id' => $item->id->videoId,
                    'title' => $item->snippet->title,
                    'description' => $item->snippet->description,
                    'thumbnail' => $item->snippet->thumbnails->high->url,
                    'channelTitle' => $item->snippet->channelTitle,
                    'publishedAt' => $item->snippet->publishedAt,
                ];
            }

            return view('youtube.index', compact('videos'));
        } catch (\Exception $e) {
            dd($e->getMessage()); // For debugging
        }
    }
}
