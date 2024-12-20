@extends('auth.layouts')

@section('content')
<link href="{{ asset('lightbox/dist/css/lightbox.min.css') }}" rel="stylesheet">
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <!-- Menambahkan kelas btn-sm untuk ukuran tombol yang lebih kecil -->
            <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary mb-3">Create</a>
            <div class="card-body">
                <div class="row" id="gallery">
                    <!-- @if(count($galleries) > 0)
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
                </div> -->
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $.get('/api/gallery', function(response) {
            console.log('Response dari API:', response);
            if (response.data) {
                let html = '';
                response.data.forEach(function(gallery) {
                    html += `
                        <div class="col-sm-2">
                            <div>
                                <a href="/storage/images/books/${gallery.picture}" data-lightbox="roadtrip" data-title="${gallery.description}">
                                    <img class="img-fluid mb-2" src="/storage/images/books/${gallery.picture}" alt="${gallery.title}" />
                                </a>
                            </div>
                        </div>`;
                });
                console.log('HTML yang akan dimasukkan:', html);
                $('#gallery').html(html);
            } else {
                $('#gallery').html('<h3 class="text-center">Tidak ada data.</h3>');
            }
        }).fail(function() {
            console.error('Gagal memuat data dari API.');
            $('#gallery').html('<h3 class="text-center text-danger">Gagal memuat data dari API.</h3>');
        });
    });
</script>
@endsection
