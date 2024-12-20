@extends('auth.layouts')

@section('content')
<link href="{{ asset('lightbox/dist/css/lightbox.min.css') }}" rel="stylesheet">
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Gallery</div>
            <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary mb-3">Create</a>
            <div class="card-body">
                <div class="row" id="gallery">
                    <!-- Data will be populated dynamically from API -->
                </div>
                <div id="pagination" class="d-flex justify-content-center mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        // Load gallery data from API
        $.get('/api/gallery', function(response) {
            if (response.status) {
                let html = '';
                response.data.forEach(function(gallery) {
                    html += `
                        <div class="col-sm-3 mb-3">
                            <div>
                                <a href="/storage/posts/${gallery.picture}" data-lightbox="roadtrip" data-title="${gallery.description}">
                                    <img class="img-fluid mb-2" src="/storage/posts/${gallery.picture}" alt="${gallery.title}" />
                                </a>
                            </div>
                        </div>`;
                });
                $('#gallery').html(html);
            } else {
                $('#gallery').html('<h3 class="text-center text-danger">Data tidak ditemukan.</h3>');
            }
        }).fail(function() {
            $('#gallery').html('<h3 class="text-center text-danger">Gagal memuat data dari API.</h3>');
        });
    });
</script>
@endsection
