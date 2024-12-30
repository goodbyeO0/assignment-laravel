<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = auth()->user()->videos;
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mov,avi|max:102400' // max 100MB
        ]);

        $video = $request->file('video');
        $userId = auth()->id();
        
        // Create user-specific directory if it doesn't exist
        $userPath = 'videos/user_' . $userId;
        if (!Storage::exists($userPath)) {
            Storage::makeDirectory($userPath);
        }

        // Store the video
        $fileName = time() . '_' . $video->getClientOriginalName();
        $filePath = $video->storeAs($userPath, $fileName, 'public');

        // Create video record
        Video::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'original_name' => $video->getClientOriginalName(),
            'user_id' => $userId
        ]);

        return redirect()->route('videos.index')->with('success', 'Video uploaded successfully');
    }
}
