@extends('layouts.app')

@section('title', 'Register New Specimen Kit - Serene Portal')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <div class="flex flex-col">
        <div class="flex items-center space-x-3 text-sm mb-4">
            <span class="text-[#0D7A5F] font-medium border-b-2 border-[#0D7A5F] pb-1">Registration</span>
            <span class="text-gray-300">|</span>
            <span class="text-gray-500 hover:text-[#0D7A5F] transition cursor-pointer">Overview</span>
        </div>
        <h1 class="text-3xl font-light text-gray-800">Register New <span class="font-semibold text-gray-800">Specimen Kit</span></h1>
        <p class="text-gray-500 text-sm mt-1">Populate the medical identifiers to securely link a new kit to the system.</p>
    </div>

    <form method="POST" action="{{ route('kits.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        @csrf
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="p-3 bg-[#E8F5F1] rounded-xl">
                        <i class="fas fa-barcode text-[#0D7A5F] text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Primary Identifiers</h2>
                        <p class="text-xs text-gray-400">General kit and patient metadata</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">Kit Code</label>
                        <div class="flex gap-3">
                            <input type="text" name="kit_code" id="kit_code" value="SK-8829-XJ" readonly
                                   class="flex-1 px-5 py-3.5 bg-[#E8F5F1] border-none rounded-xl font-mono text-sm text-gray-700 focus:ring-2 focus:ring-[#0D7A5F]">
                            <button type="button" onclick="generateKitCode()" 
                                    class="px-5 py-3.5 bg-[#D1EBE3] text-[#0D7A5F] rounded-xl text-xs font-bold uppercase tracking-tight hover:bg-[#c4e3d9] transition">
                                Regenerate
                            </button>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 flex items-center">
                            <i class="fas fa-circle-info mr-1.5 text-[#4AA6EF]"></i>
                            Standard format is auto-assigned based on facility code.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">Patient Date of Birth</label>
                            <input type="text" name="patient_dob" placeholder="mm/dd/yyyy"
                                   class="w-full px-5 py-3.5 bg-[#E8F5F1] border-none rounded-xl text-sm text-gray-700 placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">Kit Expiry Date</label>
                            <input type="text" name="expiry_date" placeholder="mm/dd/yyyy"
                                   class="w-full px-5 py-3.5 bg-[#E8F5F1] border-none rounded-xl text-sm text-gray-700 placeholder-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="p-3 bg-[#E8F5F1] rounded-xl">
                        <i class="fas fa-vial text-[#0D7A5F] text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Ordered Tests</h2>
                        <p class="text-xs text-gray-400">Select clinical tests associated with this specimen</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @foreach(['Urinalysis', 'Fecalysis', 'Urine HCG'] as $test)
                    <label class="flex items-center px-6 py-4 bg-[#E8F5F1] rounded-2xl cursor-pointer group hover:bg-[#D1EBE3] transition">
                        <input type="checkbox" name="ordered_tests[]" value="{{ $test }}" 
                               class="w-5 h-5 border-none rounded text-[#0D7A5F] focus:ring-0 bg-white">
                        <span class="ml-3 text-sm font-semibold text-gray-700">{{ $test }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-[#0D7A5F] rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-6">Laboratory Standards</h3>
                    <p class="text-sm opacity-80 leading-relaxed mb-10">
                        Ensuring specimen integrity starts with accurate registration. Please verify all identifiers against the printed patient referral form before final generation.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-5 bg-white/10 rounded-2xl border border-white/10">
                            <div class="p-2 bg-white/20 rounded-lg mr-4">
                                <i class="fas fa-shield-check text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] opacity-70 font-bold uppercase tracking-wider">Security Protocol</p>
                                <p class="text-xs font-semibold">Encrypted Data Transmission</p>
                            </div>
                        </div>

                        <div class="flex items-center p-5 bg-white/10 rounded-2xl border border-white/10">
                            <div class="p-2 bg-white/20 rounded-lg mr-4">
                                <i class="fas fa-rotate text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] opacity-70 font-bold uppercase tracking-wider">Sync Status</p>
                                <p class="text-xs font-semibold">Real-time DB connection active</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 text-center">
                <button type="submit" class="w-full bg-[#3B9E7E] hover:bg-[#2D7A61] text-white py-4 rounded-xl font-bold flex items-center justify-center shadow-lg shadow-[#3b9e7e]/20 transition mb-4">
                    <i class="fas fa-save mr-2"></i> Save & Generate Kit
                </button>
                <a href="{{ route('kits.index') }}" class="block w-full py-4 text-[#0D7A5F] bg-[#E8F5F1] rounded-xl font-bold text-sm hover:bg-[#D1EBE3] transition">
                    Cancel Registration
                </a>

                <div class="mt-8 flex items-start text-left">
                    <div class="p-2 bg-[#E8F5F1] rounded-full mr-3 mt-0.5">
                        <i class="fas fa-question text-[8px] text-[#4AA6EF]"></i>
                    </div>
                    <p class="text-[10px] text-gray-400 leading-normal">
                        By clicking save, you are authorizing the creation of a new physical kit record in the clinical tracking system.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection