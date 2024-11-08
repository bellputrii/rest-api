@extends('auth.layouts')

@section('title', 'Welcome Page')

@section('header', 'Selamat Datang di Halaman Kami')

@section('content')
<div class="mt-16">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
</div>
@endsection
