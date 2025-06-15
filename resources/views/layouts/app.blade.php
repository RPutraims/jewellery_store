<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; 
        }
        #wrapper {
            display: flex; 
            min-height: 100vh; 
        }
        #sidebar-wrapper {
            flex-shrink: 0;
            width: 20vw; 
            height: 100vh; 
            overflow-y: auto; 
            background-color: #310031; 
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        #page-content-wrapper {
            flex-grow: 1; 
            height: 100vh; 
            overflow-y: auto; 
            padding: 1.5rem; 
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div id="wrapper">
        
        <div id="sidebar-wrapper">
            @include('components.navbar')
        </div>

        <div id="page-content-wrapper">
            @if (isset($header))
                <header class="bg-purple shadow mb-4 rounded-lg p-4">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="container-fluid">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
