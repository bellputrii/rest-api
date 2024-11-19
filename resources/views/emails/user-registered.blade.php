<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pendaftaran</title>
</head>
<body>
    <h1>Halo, {{ $data_new }}!</h1>
    <p>Terima kasih telah mendaftar. Berikut informasi akun Anda:</p>
    <ul>
        <li>Email: {{ $data_new }}</li>
        <li>Tanggal Pendaftaran: {{ $registeredAt }}</li>
    </ul>
    <p>Selamat menggunakan aplikasi kami!</p>
</body>
</html>
