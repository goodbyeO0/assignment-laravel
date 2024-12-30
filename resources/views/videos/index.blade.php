@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    My Videos
                    <a href="{{ route('videos.create') }}" class="btn btn-primary btn-sm">Upload New Video</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($videos->count() > 0)
                        <div class="list-group">
                            @foreach($videos as $video)
                                <div class="list-group-item">
                                    <h5 class="mb-1">{{ $video->title }}</h5>
                                    <p class="mb-1">Original filename: {{ $video->original_name }}</p>
                                    <small class="text-muted">Uploaded: {{ $video->created_at->diffForHumans() }}</small>
                                    <video width="100%" controls class="mt-2">
                                        <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center">No videos uploaded yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection