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
        @yield('content')
    </main>

    {{-- Background section with overlay content --}}
    <div class="section">
        <div class="flex w-full justify-center">
            <div class="w-4/5">
                <img src="{{ asset('images/index_backg.webp') }}" alt="background" class="transform mx-auto brightness-50">
            </div>
        </div>
    </div>

    <main class="container mt-4">
        @yield('content')
    </main>
</body>

</html>
