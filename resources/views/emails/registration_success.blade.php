<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>
