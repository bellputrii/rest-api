@extends('auth.layouts')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Edit Gallery Item</div>
            <div class="card-body">
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="picture">Picture</label>
                        <input type="file" name="picture" class="form-control-file">
                        <small class="form-text text-muted">Leave blank if you don't want to change the picture.</small>
                    </div>

                    <div class="mb-3">
                        <label>Current Picture:</label><br>
                        <img src="{{ asset('storage/posts_image/'.$gallery->picture) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection
