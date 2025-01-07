@extends('layouts.app')

@section('styles')
<style>
    .page-header {
        padding: 1rem 0;
        margin-bottom: 2rem;
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .header-title {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .header-description {
        font-size: 0.9rem;
        color: #666;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 1rem 0;
    }

    .video-card {
        background: #ffffff;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .video-thumbnail {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        overflow: hidden;
        background: #f8f9fa;
    }

    .video-thumbnail video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-info {
        padding: 1rem;
    }

    .video-title {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .video-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.85rem;
        color: #666;
    }

    .user-link {
        color: #2196f3;
        text-decoration: none;
    }

    .user-link:hover {
        color: #1976d2;
        text-decoration: underline;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding: 2rem 0;
    }

    .pagination-container .pagination {
        margin: 0;
    }

    .pagination-container .page-link {
        background: #ffffff;
        border-color: #e0e0e0;
        color: #333;
    }

    .pagination-container .page-item.active .page-link {
        background-color: #2196f3;
        border-color: #2196f3;
        color: #fff;
    }

    .pagination-container .page-item.disabled .page-link {
        background: #f8f9fa;
        border-color: #e0e0e0;
        color: #999;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">My Videos</h1>
        <p class="header-description">Discover amazing videos from our community</p>
    </div>
</div>

<div class="container">
    <div class="video-grid">
        @foreach($videos as $video)
            <div class="video-card">
                <div class="video-thumbnail">
                    <video controls>
                        <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="video-info">
                    <h3 class="video-title">{{ $video->title }}</h3>
                    <div class="video-meta">
                        <a href="{{ route('videos.gallery', $video->user->id) }}" class="user-link">
                            <i class="fas fa-user-circle"></i> {{ $video->user->name }}
                        </a>
                        <span>
                            <i class="fas fa-clock"></i> {{ $video->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $videos->links() }}
    </div>
</div>
@endsection 