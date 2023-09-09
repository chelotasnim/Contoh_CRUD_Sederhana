<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- asset() mengarah ke folder public untuk menaruh style dan asset --}}
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">

    <title>Inventaris Buku | Masuk</title>
</head>
<body>
    <div class="page">
        <div class="card">
            <div class="image">
                <span>{!}</span>
                <p>Sistem Informasi Inventaris Buku</p>
            </div>
            <form action="{{ url('login') }}" method="post" class="form">

                {{-- url() berisi identifier web routes, sesuaikan dengan method yang ada --}}
            
                {{-- csrf token dari laravel untuk mencegah xss --}}
                @csrf

                <div class="form-header">
                    Masuk
                </div>

                @if (session()->has('fail'))
                <div class="alert-box">
                    {{ session('fail') }}
                </div>
                @endif

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email">
                    @error('email')
                        <small>*{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Kata Sandi">
                    @error('password')
                        <small>*{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn">Masuk</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('auth/script.js') }}"></script>
</body>
</html>