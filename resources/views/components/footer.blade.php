@vite(['resources/css/app.css', 'resources/js/app.js'])
<footer class="bg-purple text-gold py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            
            <!-- Column 1 -->
            <div>
                <h3 class="text-xl font-semibold mb-2">Company</h3>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">About Us</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                    <li><a href="#" class="hover:underline">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Column 2 -->
            <div>
                <h3 class="text-xl font-semibold mb-2">Navigation</h3>
                <ul class="space-y-1">
                    <li><a href="/" class="hover:underline">Home</a></li>
                    <li><a href="/services" class="hover:underline">Services</a></li>
                    <li><a href="/projects" class="hover:underline">Projects</a></li>
                </ul>
            </div>

            <!-- Column 3 -->
            <div>
                <h3 class="text-xl font-semibold mb-2">Follow Us</h3>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Instagram</a></li>
                    <li><a href="#" class="hover:underline">Facebook</a></li>
                    <li><a href="#" class="hover:underline">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 text-center text-sm text-gold/80">
            &copy; {{ date('Y') }} Ralfs Putraims un Kārlis Brahmanis
        </div>
    </div>
</footer>
