<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $story->title }}</title>
</head>
<body>
    <h1>{{ $story->title }}</h1>
    <p>Tác giả: {{ $story->author }}</p>
    <p>{{ $story->description }}</p>

    <h2>Các chương:</h2>
    <ul>
        @foreach($story->chapters as $chapter)
            <li>
                <a href="{{ route('chapter.show', $chapter->id) }}">
                    {{ $chapter->title }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
