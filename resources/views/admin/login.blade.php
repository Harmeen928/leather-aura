<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Login | Leather Aura</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1">
</head>
<body>
<div class="login">
    <form class="card" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <h1>LEATHER<span style="color:#d9622b">AURA</span> Admin</h1>
        <div style="margin-bottom:16px">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div style="margin-bottom:16px">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <label class="chk" style="margin-bottom:18px"><input type="checkbox" name="remember" value="1"> Remember me</label>
        <button class="btn" style="width:100%" type="submit">Login</button>
    </form>
</div>
</body>
</html>
