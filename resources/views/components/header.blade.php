<header class="w-full bg-white/80 backdrop-blur-md px-12 py-5 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <div class="text-[#0D7A5F] text-lg font-bold flex items-center tracking-tight">
            <i class="fas fa-shield-halved mr-2"></i> Serene Portal
        </div>
    </div>
    
    <nav class="flex items-center space-x-8 text-[11px] font-bold uppercase tracking-wider">
        @guest
            <a href="{{ route('patient.access.form') }}" class="text-[#0D7A5F] border-b-2 border-[#0D7A5F] pb-1">Access view Result</a>
            <a href="{{ route('login') }}" class="text-gray-400 hover:text-[#0D7A5F] transition">Login as admin</a>
        @endguest
    </nav>

    <div class="alignment-right text-gray-400 hover:text-gray-600 cursor-pointer transition">
        <i class="far fa-question-circle text-lg"></i>
    </div>

    <!-- User Menu -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg px-3 py-2 transition">
            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="text-left hidden md:block">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin User' }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->role ?? 'Administrator' }}</p>
            </div>
            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
        </button>
        
        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" 
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-2 z-30"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100">
            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-user w-5 mr-3"></i> Profile
            </a>
            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-cog w-5 mr-3"></i> Settings
            </a>
            <hr class="my-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5 mr-3"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>