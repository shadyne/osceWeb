<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login &mdash; OS3CODE</title>

    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body.login-page {
            background: linear-gradient(135deg, #1f2937, #3f2b63, #6b2d5c);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
            font-family: 'Poppins', sans-serif;
        }
        @keyframes gradientMove {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body.login-page::before,
        body.login-page::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(85px);
            opacity: 0.35;
        }
        body.login-page::before {
            width: 320px; height: 320px;
            background: #ff7ac6;
            top: -100px; left: -80px;
        }
        body.login-page::after {
            width: 350px; height: 350px;
            background: #8b5cf6;
            bottom: -120px; right: -100px;
        }

        .top-logos-container {
            position: absolute;
            top: 25px;
            right: 30px;
            z-index: 999;
        }
        .top-logo-img {
            height: 55px;
            width: auto;
            filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));
        }

        .login-box {
            width: 420px;
            z-index: 2;
        }
        .login-box-body {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 28px;
            padding: 45px 35px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.35), inset 0 0 0.5px rgba(255,255,255,0.4);
            color: white;
            position: relative;
            overflow: hidden;
        }
        .login-box-body::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.03), transparent);
            transform: rotate(25deg);
            pointer-events: none;
        }

        .login-logo-center {
            display: block;
            margin: 0 auto 20px;
            max-width: 130px;
            height: auto;
            filter: drop-shadow(0 0 20px rgba(255,255,255,0.2));
        }

        .main-title {
            color: white;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        .main-title b { color: #ffb3e6; }
        .subtitle {
            text-align: center;
            color: rgba(255,255,255,0.72);
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-control {
            height: 50px;
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.06);
            color: white !important;
            padding-left: 16px !important;
            padding-right: 50px !important;
            transition: all 0.3s ease;
            font-size: 14px;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #ff7ac6;
            box-shadow: 0 0 0 4px rgba(255,122,198,0.18);
            background: rgba(255,255,255,0.08);
        }
        .form-control::placeholder { color: rgba(255,255,255,0.55); }
        .form-group { margin-bottom: 20px; position: relative; }

        .form-control-feedback {
            position: absolute;
            right: 16px !important;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.75);
            font-size: 17px;
            line-height: 1;
            pointer-events: none;
        }

        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute;
            top: 50%; right: 16px;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.75);
            cursor: pointer;
            z-index: 99;
            font-size: 17px;
            line-height: 1;
            transition: 0.3s;
        }
        .password-toggle:hover { color: white; }

        .btn-primary {
            background: linear-gradient(135deg, #ff7ac6, #a855f7) !important;
            border: none !important;
            border-radius: 14px;
            height: 48px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(255,122,198,0.28);
            width: 100%;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,122,198,0.4);
        }

        .checkbox label {
            color: rgba(255,255,255,0.82);
            font-size: 13px;
        }

        .callout-danger {
            background: rgba(239,68,68,0.15);
            border-left: 4px solid #ef4444;
            color: #fff;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .login-box { width: 92%; }
            .login-box-body { padding: 35px 25px; }
        }
    </style>
</head>
<body class="login-page">

<div class="top-logos-container">
    <img src="<?= base_url('assets/dist/img/logo_poltekkes.png') ?>"
         class="top-logo-img" alt="Logo Poltekkes">
</div>

<div class="login-box">
    <div class="login-box-body">
        <img src="<?= base_url('assets/dist/img/logo_osce.png') ?>"
             class="login-logo-center" alt="Logo OSCE">

        <div class="main-title">
            <b>OS3</b>CODE
        </div>
        <div class="subtitle">Sistem Penilaian OSCE Stase 3 Koding</div>

        <?php if ($err = $this->session->flashdata('error')): ?>
            <div class="callout-danger text-center"><?= e($err) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('login') ?>" id="login">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control"
                       placeholder="Username" required autofocus>
                <span class="fa fa-user form-control-feedback"></span>
            </div>

            <div class="form-group">
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-control"
                           placeholder="Password" required>
                    <span class="fa fa-eye password-toggle" id="togglePassword"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" id="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-5">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput  = document.querySelector('input[name="password"]');
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
