@extends('layouts.app')

@section('title', 'Dashboard - Serene Portal')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-light text-gray-800">Clinical <span class="text-[#0D7A5F] font-semibold">Overview</span></h1>
            <p class="text-gray-500 text-sm mt-1">Managing diagnostics and patient flow for North Wing Medical Facility.</p>
        </div>
        <button class="bg-[#0D7A5F] hover:bg-[#0a634d] text-white px-5 py-2.5 rounded-xl font-medium flex items-center shadow-sm transition">
            <a href="{{ route('kits.create') }}" class="bg-[#0D7A5F] hover:bg-[#0a634d] text-white px-5 py-2.5 rounded-xl font-medium flex items-center shadow-sm transition inline-flex">
                <i class="fas fa-plus-circle mr-2"></i> Create New Kit
            </a>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#0D7A5F]"></div>
            <div class="flex justify-between items-start">
                <div class="p-2 bg-gray-50 rounded-lg">
                    <i class="fas fa-box-archive text-[#0D7A5F]"></i>
                </div>
                <span class="text-[10px] font-bold text-[#0D7A5F] bg-[#E8F5F1] px-2 py-0.5 rounded-full">+12.5%</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Total Kits</p>
                <p class="text-4xl font-bold text-gray-800 mt-1">{{ number_format($totalKits) }}</p>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#4AA6EF]"></div>
            <div class="flex justify-between items-start">
                <div class="p-2 bg-gray-50 rounded-lg">
                    <i class="fas fa-clipboard-list text-[#4AA6EF]"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full uppercase">Active</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Pending Results</p>
                <p class="text-4xl font-bold text-gray-800 mt-1">{{ $pendingResults }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#2BB181]"></div>
            <div class="flex justify-between items-start">
                <div class="p-2 bg-gray-50 rounded-lg">
                    <i class="fas fa-circle-check text-[#2BB181]"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full uppercase">Done</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Completed</p>
                <p class="text-4xl font-bold text-gray-800 mt-1">{{ number_format($completed) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#3B546E]"></div>
            <div class="flex justify-between items-start">
                <div class="p-2 bg-gray-50 rounded-lg">
                    <i class="fas fa-paper-plane text-[#3B546E]"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full uppercase">Weekly</span>
            </div>
            <div class="mt-4">
                <p class="text-gray-400 text-xs font-bold tracking-wider uppercase">Released</p>
                <p class="text-4xl font-bold text-gray-800 mt-1">{{ $released }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h2 class="text-lg font-bold text-gray-800">Active Kit Pipeline</h2>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-[#BDCED9] text-[#3B546E] rounded-md text-[10px] font-bold uppercase tracking-tight">Diagnostic</span>
                    <span class="px-3 py-1 bg-[#C9E7F2] text-[#4AA6EF] rounded-md text-[10px] font-bold uppercase tracking-tight">Urgent</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400 text-xs"></i>
                    <input type="text" id="kitSearch" onkeyup="searchKits()" 
                           placeholder="Search kit ID or patient..." 
                           class="pl-10 pr-4 py-2.5 bg-[#E8F5F1] border-none rounded-xl text-sm w-72 focus:ring-2 focus:ring-[#0D7A5F] placeholder-gray-400">
                </div>
                <button class="p-2.5 bg-gray-50 text-gray-400 rounded-xl hover:text-gray-600 border border-gray-100">
                    <i class="fas fa-sliders text-sm"></i>
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-bold text-gray-400 tracking-widest uppercase border-b border-gray-50">
                        <th class="px-8 py-4 font-bold">Kit Code</th>
                        <th class="px-8 py-4 font-bold">Patient DOB</th>
                        <th class="px-8 py-4 font-bold">Status</th>
                        <th class="px-8 py-4 font-bold text-center">Assigned Tests</th>
                        <th class="px-8 py-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentKits as $kit)
                    <tr class="kit-row group hover:bg-[#F0FAF7] transition">
                        <td class="px-8 py-5">
                            <span class="px-3 py-1.5 bg-[#E8F5F1] text-[#0D7A5F] rounded-md font-mono text-xs font-bold">{{ $kit->kit_code }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center text-sm font-medium text-gray-700">
                                {{ $kit->patient->date_of_birth->format('Y-**-**') }}
                                <span class="ml-2 text-[10px] text-gray-400 font-normal tracking-wide uppercase">PIN: {{ $kit->patient->pin }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="status-badge 
                                @if($kit->status == 'pending') status-pending
                                @elseif($kit->status == 'partial') status-partial
                                @elseif($kit->status == 'complete') status-complete
                                @else status-released @endif">
                                <i class="fas fa-circle text-[6px] mr-2"></i> {{ ucfirst($kit->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center space-x-1">
                                @foreach($kit->ordered_tests as $test)
                                    <span class="px-2 py-0.5 bg-[#D1EBE3] text-[#0D7A5F] rounded text-[10px] font-bold font-mono">{{ strtoupper(substr($test, 0, 3)) }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="text-[10px] font-bold text-gray-400 tracking-widest uppercase group-hover:text-[#0D7A5F] transition">Actions</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-10 text-center text-gray-400 italic">No kits currently in pipeline.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-8 py-5 bg-gray-50/50 flex justify-between items-center">
            <div class="text-[11px] text-gray-400 font-medium">
                Showing <span class="text-gray-700">4 of {{ number_format($totalKits) }}</span> records
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-1.5 text-[11px] font-bold text-gray-400 hover:text-gray-600">Previous</button>
                <button class="px-6 py-1.5 text-[11px] font-bold bg-[#0D7A5F] text-white rounded-lg shadow-sm">Next</button>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-[#F0FAF7] border border-[#D1EBE3] rounded-2xl p-8 flex items-center">
            <div class="w-20 h-20 bg-black rounded-2xl mr-8 flex-shrink-0 flex items-center justify-center overflow-hidden">
                <i class="fas fa-microchip text-teal-400 text-3xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Automated Validation</h3>
                <p class="text-sm text-gray-500 mt-1 leading-relaxed">Our AI-assisted validation system is currently processing 18 pending urinalysis results for consistency check.</p>
                <a href="#" class="mt-4 inline-block text-[11px] font-bold text-[#0D7A5F] uppercase tracking-widest hover:underline">Review Protocol <i class="fas fa-arrow-right-long ml-1"></i></a>
            </div>
        </div>
        
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Lab Connection Status</h3>
                <div class="flex items-center">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-2"></div>
                    <span class="text-[10px] font-bold text-green-500 uppercase">Live</span>
                </div>
            </div>
            
            <div class="w-full h-2 bg-[#F0FAF7] rounded-full overflow-hidden mb-8">
                <div class="w-4/5 h-full bg-[#0D7A5F] rounded-full"></div>
            </div>

            <div class="flex justify-between text-[10px] font-bold text-gray-300 tracking-wide">
                <span>SYSTEM LATENCY: 14MS</span>
                <span>LAST SYNC: 2 MINUTES AGO</span>
            </div>
        </div>
    </div>
</div>
@endsection