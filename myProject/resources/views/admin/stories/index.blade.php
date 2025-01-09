@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Danh sách Truyện</h1>
        <a href="{{ route('stories.create') }}" class="btn btn-primary">Thêm Truyện</a>
        
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Truyện</th>
                    <th>Tác Giả</th>
                    <th>Miêu Tả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stories as $story)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $story->title }}</td>
                        <td>{{ $story->author }}</td>
                        <td>{{ $story->description }}</td>
                        <td>
                            <a href="{{ route('stories.edit', $story->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('stories.destroy', $story->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection