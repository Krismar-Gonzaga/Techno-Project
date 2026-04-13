@php
    $currentRoute = Route::currentRouteName();
    
    // Set page title based on route
    if ($currentRoute === 'dashboard') {
        $pageTitle = 'Clinical Overview';
        $pageSubtitle = 'Managing diagnostics and patient flow for North Wing Medical Facility.';
    } elseif ($currentRoute === 'kits.index') {
        $pageTitle = 'Kit Management';
        $pageSubtitle = 'Manage and track all laboratory specimen kits.';
    } elseif ($currentRoute === 'kits.create') {
        $pageTitle = 'Register New Specimen Kit';
        $pageSubtitle = 'Populate the medical identifiers to securely link a new kit to the system.';
    } elseif ($currentRoute === 'kits.upload-results') {
        $pageTitle = 'Upload Results';
        $pageSubtitle = 'Enter diagnostic data for the patient\'s submitted samples.';
    } else {
        $pageTitle = 'Dashboard';
        $pageSubtitle = 'Welcome to Serene Portal Medical System';
    }
@endphp

<header class="bg-white border-b sticky top-0 z-10">
    <div class="px-6 py-4">
        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <!-- Page Title Area -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $pageTitle }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $pageSubtitle }}</p>
            </div>
            
            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                <!-- Create New Kit Button (Visible on relevant pages) -->
                @if(in_array($currentRoute, ['dashboard', 'kits.index']))
                <a href="{{ route('kits.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Create New Kit
                </a>
                @endif
                
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
            </div>
        </div>
    </div>
</header>