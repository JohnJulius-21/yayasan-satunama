<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4 border-0">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/stc.png') }}" alt="Logo" style="max-width: 80px;" class="mb-3">
                            <h4 class="fw-bold">Reset Password</h4>
                            <p class="text-muted">Masukkan password baru untuk akun kamu.</p>
                        </div>

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru" required>
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" required>
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Reset Password</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('beranda') }}" class="text-decoration-none text-success">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
