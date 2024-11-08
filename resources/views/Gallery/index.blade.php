@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <!-- Menambahkan kelas btn-sm untuk ukuran tombol yang lebih kecil -->
            <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary mb-3">Create</a>
            <div class="card-body">
                <div class="row">
                    @if(count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="col-sm-2">
                                <div class="card mb-2">
                                    <a href="{{ asset('storage/posts/'.$gallery->picture) }}" data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                        <img src="{{ asset('storage/posts/'.$gallery->picture) }}" class="img-fluid" alt="Image"/>
                                    </a>
                                    <div class="card-body text-center">
                                        <p>{{ $gallery->title }}</p>
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center">Tidak ada data.</h3>
                    @endif
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/lightbox.js') }}"></script>
@endsection
