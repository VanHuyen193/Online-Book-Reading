@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Thêm Truyện Mới</h1>

        <form action="{{ route('stories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Tên Truyện</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="author">Tác Giả</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Miêu Tả</label>
                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Lưu Truyện</button>
        </form>
    </div>
@endsection
