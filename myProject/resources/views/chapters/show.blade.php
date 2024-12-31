<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $chapter->title }}</title>
</head>
<body>
    <h1>{{ $chapter->title }}</h1>
    <p>{!! nl2br(e($chapter->content)) !!}</p>
    <a href="{{ route('story.show', $chapter->story_id) }}">Quay lại danh sách chương</a>
</body>
</html>
