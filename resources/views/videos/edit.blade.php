@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Video</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('videos.update', $video) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="title">Video Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Current Video</label>
                            <div class="mt-2">
                                <video width="100%" controls>
                                    <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="video">Replace Video (Optional)</label>
                            <input type="file" class="form-control" id="video" name="video" accept="video/*">
                            <small class="text-muted">Maximum file size: 100MB. Supported formats: MP4, MOV, AVI</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Video</button>
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 