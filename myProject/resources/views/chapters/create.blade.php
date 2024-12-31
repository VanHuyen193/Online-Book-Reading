<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Chương</title>
</head>
<body>
    <h1>Thêm Chương Mới</h1>
    <form action="{{ route('chapters.store') }}" method="POST">
        @csrf
        <input type="hidden" name="story_id" value="{{ $story_id }}">
        <label for="title">Tiêu Đề:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Nội Dung:</label>
        <textarea name="content" id="content" rows="10" required></textarea>
        <br>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
