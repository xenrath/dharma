<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>LOGIN | SIDHARMA</title>
    <link rel="icon" href="{{ asset('storage/uploads/asset/logo-lppm.png') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>


<body class="hold-transition">

    @include('sweetalert::alert')

    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}">
                    <b>SIDHARMA</b>
                    LPPM
                </a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Masukan Username dan Password</p>
                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="text" id="username" name="username"
                                    class="form-control rounded-0 @error('username') is-invalid @enderror"
                                    placeholder="username" value="{{ old('username') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text rounded-0">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            @error('username')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                    class="form-control rounded-0 @error('password') is-invalid @enderror"
                                    placeholder="password" value="{{ old('password') }}">
                                <div class="input-group-append bg-light" style="cursor: pointer;"
                                    onclick="showPassword()">
                                    <div class="input-group-text rounded-0">
                                        <span class="fas fa-eye" id="icon-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-flat btn-block">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPassword() {
            var password = document.getElementById('password');
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var icon_eye = document.getElementById('icon-eye');
            var icon_change = icon_eye.className === 'fas fa-eye' ? 'fas fa-eye-slash' : 'fas fa-eye';
            icon_eye.className = icon_change;
        }
    </script>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
