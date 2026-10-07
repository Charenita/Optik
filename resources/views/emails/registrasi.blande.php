<!DOCTYPE html>
<html>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

<div style="max-width:500px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <h2 style="color:#14b8a6;">Registrasi Berhasil 🎉</h2>

    <p>Halo <b>{{ $user->username }}</b>,</p>

    <p>Akun kamu sudah berhasil dibuat.</p>

    <p><b>Email:</b> {{ $user->email }}</p>

    <p>Silakan login dan mulai diagnosa.</p>

    <br>

    <p style="font-size:12px; color:gray;">
        Email ini dikirim otomatis oleh sistem.
    </p>

</div>

</body>
</html>