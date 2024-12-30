<!DOCTYPE html>
<html>
<head>
    <title>YouTube Videos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .embed-responsive {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
        .embed-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            background: #000;
            cursor: pointer;
        }

        .video-thumbnail {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 68px;
            height: 48px;
            background-color: rgba(0,0,0,0.7);
            border-radius: 8px;
            transition: all 0.2s;
        }

        .play-button:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-40%, -50%);
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 10px 0 10px 20px;
            border-color: transparent transparent transparent white;
        }

        .video-container:hover .play-button {
            background-color: #3498db;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>YouTube Videos</h1>
        
        <div class="row">
            @if(empty($videos))
                <div class="alert alert-warning">
                    No videos found or there was an error loading the videos.
                </div>
            @endif
            @foreach($videos as $video)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <!-- Video Embed -->
                        <div class="video-container" id="player-{{ $video['id'] }}">
                            <img 
                                src="https://img.youtube.com/vi/{{ $video['id'] }}/maxresdefault.jpg" 
                                class="video-thumbnail"
                                alt="{{ $video['title'] }}"
                            >
                            <div class="play-button"></div>
                        </div>
                        
                        <!-- Video Info -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $video['title'] }}</h5>
                            <p class="card-text">{{ Str::limit($video['description'], 100) }}</p>
                            <div class="text-muted">
                                <small>Channel: {{ $video['channelTitle'] }}</small><br>
                                <small>Published: {{ \Carbon\Carbon::parse($video['publishedAt'])->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
    document.querySelectorAll('.video-container').forEach(container => {
        container.addEventListener('click', function() {
            const videoId = this.id.replace('player-', '');
            this.innerHTML = `
                <iframe 
                    src="https://www.youtube.com/embed/${videoId}?autoplay=1&modestbranding=1&showinfo=0&rel=0&iv_load_policy=3"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </iframe>
            `;
        });
    });
    </script>
</body>
</html>