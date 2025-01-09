@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Thêm Chương Mới cho Truyện: {{ $story->title }}</h1>

        <form action="{{ route('chapters.store', $story->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Tiêu Đề Chương</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="content">Nội Dung Chương</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Lưu Chương</button>
        </form>
    </div>
@endsection
