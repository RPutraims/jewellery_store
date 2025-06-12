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
        /* Ensure html and body take full height */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Hide scrollbars if content overflows initially */
        }
        #wrapper {
            display: flex; /* This is the key for a side-by-side layout */
            min-height: 100vh; /* Ensure it takes at least the full viewport height */
        }
        #sidebar-wrapper {
            /* flex-shrink-0 prevents it from shrinking */
            flex-shrink: 0;
            /* Calculate 1/5 of the viewport width */
            width: 20vw; /* 20% of viewport width */
            /* Ensure the sidebar takes full height and allows scrolling if content overflows */
            height: 100vh; /* Takes full viewport height */
            overflow-y: auto; /* Adds scrollbar if sidebar content is too long */
            /* Add background and shadow for visual separation */
            background-color: #310031; /* Adjust to your 'bg-purple' color */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        #page-content-wrapper {
            flex-grow: 1; /* Allows content to take all remaining space */
            /* Allows content to scroll independently */
            height: 100vh; /* Takes full viewport height */
            overflow-y: auto; /* Adds scrollbar if main content is too long */
            padding: 1.5rem; /* Add some padding around your main content */
        }

        /* Adjustments for your custom 'gold' and 'purple' colors if they are not Tailwind defaults */
        .bg-purple { background-color: #310031; } /* Example dark purple */
        .text-gold { color: #FFD700; } /* Example gold color */
        /* If these are in your tailwind.config.js, you might not need these inline styles */
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