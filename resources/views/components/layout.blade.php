<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMJewellery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .bg-purple { background-color: #310031; } 
        .text-gold { color: #FFD700; }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            @include('components.navbar')
        </div>
        <div id="page-content-wrapper">
            @if (trim($header ?? ''))
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>