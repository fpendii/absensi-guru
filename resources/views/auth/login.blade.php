<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<style>
    body {
        background: #f0f4f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .login-container {
        background: white;
        padding: 2.5rem 3rem;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 350px;
        text-align: center;
    }
    h2 {
        margin-bottom: 1.5rem;
        color: #333;
    }
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0 20px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 8px #3b82f6aa;
    }
    button {
        width: 100%;
        padding: 12px 0;
        background-color: #3b82f6;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #2563eb;
    }
    .error-messages {
        background-color: #fee2e2;
        color: #b91c1c;
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 6px;
        text-align: left;
        font-size: 0.9rem;
    }
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus />
        <input type="password" name="password" placeholder="Password" required />

        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
