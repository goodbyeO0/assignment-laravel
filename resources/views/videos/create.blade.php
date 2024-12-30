@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Video</div>

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

                    <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Video Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="video">Video File</label>
                            <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
                            <small class="text-muted">Maximum file size: 100MB. Supported formats: MP4, MOV, AVI</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Video</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection