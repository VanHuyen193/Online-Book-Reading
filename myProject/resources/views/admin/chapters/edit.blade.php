@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Sửa Chương: {{ $chapter->title }}</h1>

        <form action="{{ route('chapters.update', [$story->id, $chapter->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tiêu Đề Chương</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $chapter->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Nội Dung Chương</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $chapter->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Cập Nhật Chương</button>
        </form>
    </div>
@endsection
