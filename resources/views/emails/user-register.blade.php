@extends('auth.layouts')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pendaftaran</title>
</head>
<body>
    <h1>Halo, {{ $user['name'] }}!</h1>
    <p>Terima kasih telah mendaftar. Berikut informasi akun Anda:</p>
    <ul>
        <li>Nama: {{ $user['name'] }}</li>
        <li>Email: {{ $user['email'] }}</li>
        <li>Tanggal Pendaftaran: {{ $user['create_at'] }}</li>
    </ul>
    <p>Selamat menggunakan aplikasi kami!</p>
</body>
</html>
@endsection
