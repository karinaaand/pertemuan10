<!-- resources/views/layouts/layout.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <h1>Website Laravel Saya</h1>
        <nav>
            <a href="/">Beranda</a>
            <a href="/tentang">Tentang</a>
            <a href="/kontak">Kontak</a>
        </nav>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        <p>&copy; 2024 Website Laravel Saya</p>
    </div>
</body>
</html>
