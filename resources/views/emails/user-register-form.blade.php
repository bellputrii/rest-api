@extends('auth.layouts')

@section('content')
<div class="row justify-content-center">
    <h3 class="text-center">Form Pendaftaran</h3>
    <div class="col-md-8 p-4">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('user-registered') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group my-3">
                <label for="email_new">Email</label>
                <input type="email" class="form-control" name="email_new" id="email_new" placeholder="Masukkan Email" required>
            </div>
            <div class="form-group my-3">
                <label for="subject1">Subjek</label>
                <input type="text" class="form-control" name="subject1" id="subject1" placeholder="Masukkan Subjek" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
