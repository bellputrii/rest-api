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
    <h1>Halo, {{ $data['name'] }}!</h1>
    <p>Terima kasih telah mendaftar. Berikut informasi akun Anda:</p>
    <ul>
        <li>Email: {{ $data['email_new'] }}</li>
        <li>Tanggal Pendaftaran: {{ $data['registeredAt'] }}</li>
    </ul>
    <p>Selamat menggunakan aplikasi kami!</p>
</body>
</html>
@endsection
