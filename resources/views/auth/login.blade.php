<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventory App</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; font-family: Arial, sans-serif;
            background: #f1f5f9; min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .card {
            background: white; width: 360px; max-width: 92%;
            padding: 30px; border-radius: 12px;
            box-shadow: 0 8px 25px #00000012;
        }
        h2 { margin-top: 0; color: #1e293b; }
        p { color: #64748b; }
        label { display: block; margin: 16px 0 6px; }
        input {
            width: 100%; padding: 11px; border: 1px solid #cbd5e1;
            border-radius: 6px; font-size: 15px;
        }
        button {
            width: 100%; margin-top: 22px; padding: 12px;
            border: 0; border-radius: 6px; color: white;
            background: #2563eb; cursor: pointer; font-size: 16px;
        }
        .error { color: #dc2626; font-size: 14px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Inventory App</h2>
    <p>Silakan masuk menggunakan akun Anda.</p>

    @if ($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <label for="username">Username</label>
        <input id="username" name="username" value="{{ old('username') }}"
               required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>