<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách truyện</title>
</head>
<body>
    <h1>Danh sách truyện</h1>
    <ul>
        @foreach($stories as $story)
            <li>
                <a href="{{ route('story.show', $story->id) }}">
                    {{ $story->title }} - Tác giả: {{ $story->author }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
