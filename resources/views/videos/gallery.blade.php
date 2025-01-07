@extends('layouts.app')

@section('styles')
<style>
    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .video-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .video-card:hover {
        transform: translateY(-5px);
    }

    .video-thumbnail {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background: #f0f0f0;
        overflow: hidden;
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
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .video-meta {
        color: #666;
        font-size: 0.9rem;
    }

    .user-profile {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
    }

    .profile-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 60px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #4f46e5;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .profile-stats {
        display: flex;
        gap: 2rem;
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding: 2rem 0;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .back-button:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="user-profile">
    <div class="profile-content">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div class="profile-info">
            <a href="{{ route('videos.public') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Gallery
            </a>
            <h1 class="profile-name">{{ $user->name }}'s Videos</h1>
            <div class="profile-stats">
                <div class="stat-item">
                    <i class="fas fa-video"></i>
                    <span>{{ $videos->total() }} Videos</span>
                </div>
                @if($user->wallet_address)
                <div class="stat-item">
                    <i class="fas fa-wallet"></i>
                    <a href="https://sepolia.etherscan.io/address/{{ $user->wallet_address }}" 
                       target="_blank" 
                       class="text-white text-decoration-none">
                        View Wallet
                    </a>
                </div>
                @endif
            </div>
        </div>
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
                        <i class="fas fa-clock"></i> {{ $video->created_at->diffForHumans() }}
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