<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Inicio de sesión del sistema" />
    <meta name="author" content="Ewarte" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('{{ asset('img/fondo1.png') }}'); /* URL de la imagen de fondo */
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .login-container {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container img {
            width: 95%;
            height: 200px;
            margin-bottom: 20px;
            border-radius: 1%;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 102%;
            margin-top: 10px;
        }
        .login-container button:hover {
            background: #0056b3;
        }

        /* Media Queries */
        @media (max-width: 768px) { /* Dispositivos móviles */
            .login-container {
                width: 90%;
                padding: 15px;
            }
            .login-container h1 {
                font-size: 20px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) { /* Laptops */
            .login-container {
                width: 350px;
                padding: 25px;
            }
            .login-container h1 {
                font-size: 22px;
            }
        }
    </style>
    <title>Login - SB Admin</title>
</head>
<body>
    <div class="bg"></div>
    <div class="login-container">
        <img src="{{ asset('img/fondo1.png') }}"/>
        <h1>Iniciar Sesión</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <input type="text" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required />
                @error('email')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required />
                @error('password')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
