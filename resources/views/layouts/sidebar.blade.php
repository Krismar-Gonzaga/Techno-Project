<aside class="w-64 bg-[#F0FAF7] fixed h-full z-20 flex flex-col border-r border-gray-200">
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-[#0D7A5F] rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-briefcase-medical text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-[#0D7A5F] leading-none">Admin Panel</h1>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">Medical System</p>
            </div>
        </div>
    </div>
    
    <nav class="mt-4 flex-grow px-4">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 mb-2 transition-all duration-200 rounded-full {{ request()->routeIs('dashboard') ? 'bg-white text-[#0D7A5F] shadow-sm font-semibold' : 'text-gray-500 hover:text-[#0D7A5F]' }}">
            <i class="fas fa-th-large w-5 mr-3"></i>
            <span class="text-sm">Dashboard</span>
        </a>
        
        <a href="{{ route('kits.index') }}" 
           class="flex items-center px-4 py-3 mb-2 transition-all duration-200 rounded-full {{ request()->routeIs('kits.*') ? 'bg-white text-[#0D7A5F] shadow-sm font-semibold' : 'text-gray-500 hover:text-[#0D7A5F]' }}">
            <i class="fas fa-archive w-5 mr-3"></i>
            <span class="text-sm">Kit Management</span>
        </a>
        
        <a href="#" class="flex items-center px-4 py-3 mb-2 text-gray-500 hover:text-[#0D7A5F] transition-all rounded-full">
            <i class="fas fa-user-friends w-5 mr-3"></i>
            <span class="text-sm">Patient Records</span>
        </a>
        
        <a href="#" class="flex items-center px-4 py-3 mb-2 text-gray-500 hover:text-[#0D7A5F] transition-all rounded-full">
            <i class="fas fa-chart-bar w-5 mr-3"></i>
            <span class="text-sm">Analytics</span>
        </a>
        
        <a href="#" class="flex items-center px-4 py-3 mb-2 text-gray-500 hover:text-[#0D7A5F] transition-all rounded-full">
            <i class="fas fa-cog w-5 mr-3"></i>
            <span class="text-sm">Settings</span>
        </a>
    </nav>
    
    <div class="p-4 border-t border-gray-100">
        <button class="w-full bg-[#2D9F83] hover:bg-[#24826B] text-white py-3 rounded-xl flex items-center justify-center shadow-lg transition-transform active:scale-95 mb-6">
            <i class="fas fa-plus mr-2 text-sm"></i>
            <span class="text-sm font-semibold">New Lab Request</span>
        </button>

        <div class="space-y-1">
            <a href="#" class="flex items-center px-4 py-2 text-gray-500 hover:text-[#0D7A5F] text-xs font-medium">
                <i class="fas fa-headset w-5 mr-3"></i> Support
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-500 hover:text-red-500 text-xs font-medium">
                    <i class="fas fa-sign-out-alt w-5 mr-3"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>