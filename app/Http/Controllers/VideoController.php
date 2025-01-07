<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
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

    public function edit(Video $video)
    {
        // Check if the video belongs to the authenticated user
        if ($video->user_id !== auth()->id()) {
            return redirect()->route('videos.index')->with('error', 'Unauthorized access');
        }

        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        // Check if the video belongs to the authenticated user
        if ($video->user_id !== auth()->id()) {
            return redirect()->route('videos.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:102400' // max 100MB
        ]);

        // Update title
        $video->title = $request->title;

        // If a new video file is uploaded
        if ($request->hasFile('video')) {
            // Delete old video file
            Storage::disk('public')->delete($video->file_path);

            $newVideo = $request->file('video');
            $userId = auth()->id();
            $userPath = 'videos/user_' . $userId;
            
            // Store new video
            $fileName = time() . '_' . $newVideo->getClientOriginalName();
            $filePath = $newVideo->storeAs($userPath, $fileName, 'public');

            $video->file_path = $filePath;
            $video->original_name = $newVideo->getClientOriginalName();
        }

        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video updated successfully');
    }

    public function destroy(Video $video)
    {
        // Check if the video belongs to the authenticated user
        if ($video->user_id !== auth()->id()) {
            return redirect()->route('videos.index')->with('error', 'Unauthorized access');
        }

        // Delete the video file from storage
        Storage::disk('public')->delete($video->file_path);

        // Delete the database record
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }

    public function userGallery($userId)
    {
        $user = User::findOrFail($userId);
        $videos = Video::where('user_id', $userId)
                      ->orderBy('created_at', 'desc')
                      ->paginate(12);
        
        return view('videos.gallery', compact('videos', 'user'));
    }

    public function publicIndex()
    {
        $videos = Video::with('user')
                      ->orderBy('created_at', 'desc')
                      ->paginate(12);
        
        return view('videos.public', compact('videos'));
    }
}
