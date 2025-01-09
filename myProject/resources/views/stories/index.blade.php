<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách truyện</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Danh sách truyện</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('stories.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm truyện hoặc tác giả" value="{{ $search }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <!-- Hiển thị danh sách truyện -->
    <div class="row">
        @forelse ($stories as $story)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $story->thumbnail ?? 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $story->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">Tác giả: {{ $story->author }}</p>
                        <p class="card-text">{{ Str::limit($story->description, 100) }}</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Không tìm thấy truyện nào.</p>
        @endforelse
    </div>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $stories->links('pagination::bootstrap-5') }}
    </div>
</div>
</body>
</html>
