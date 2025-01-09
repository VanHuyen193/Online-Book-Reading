<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $chapter->title }} - {{ $story->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>{{ $story->title }}</h1>
    <h2>Chương {{ $chapter->chapter_number }}: {{ $chapter->title }}</h2>
    <hr>

    <!-- Nội dung chương -->
    <div class="content">
        {!! nl2br(e($chapter->content)) !!}
    </div>

    <hr>
    <!-- Điều hướng chương -->
    <div class="d-flex justify-content-between">
        @if ($previousChapter)
            <a href="{{ route('chapters.show', [$story->id, $previousChapter->id]) }}" class="btn btn-outline-primary">Chương trước</a>
        @else
            <button class="btn btn-outline-secondary" disabled>Chương trước</button>
        @endif

        @if ($nextChapter)
            <a href="{{ route('chapters.show', [$story->id, $nextChapter->id]) }}" class="btn btn-outline-primary">Chương sau</a>
        @else
            <button class="btn btn-outline-secondary" disabled>Chương sau</button>
        @endif
    </div>
</div>
</body>
</html>
