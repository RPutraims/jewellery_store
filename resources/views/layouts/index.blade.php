<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MyApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('components.navbar')

    <main class="container mt-4">
        @yield('content')  {{-- ✅ This yields page-specific content --}}
    </main>

    @include('components.footer') 
    <main class="container mt-4">
        @yield('content')  {{-- ✅ This yields page-specific content --}}
    </main>
</body>
</html>
