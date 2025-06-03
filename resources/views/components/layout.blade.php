<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HMJewellery</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body>
    <nav>
       @include('components.navbar')

        <main class="container mt-4">
            @yield('content')
        </main> 
    </nav>
    
<main class="container">
{{ $slot }}
</main>
<footer>
    @include('components.footer')

    <main class="container mt-4">
        @yield('content')
    </main> 
</footer>
</body>
</html>