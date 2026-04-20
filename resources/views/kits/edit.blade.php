@extends('layouts.app')

@section('title', 'Edit Kit - ' . $kit->kit_code)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">
                <span>Kit Management</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-[#0D7A5F]">Edit Kit</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Kit: {{ $kit->kit_code }}</h1>
            <p class="text-sm text-gray-500 mt-1">Update kit information and patient details</p>
        </div>
        
        <a href="{{ route('kits.index') }}" 
           class="border border-gray-300 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form method="POST" action="{{ route('kits.update', $kit->id) }}" class="p-8">
            @csrf
            @method('PUT')
            
            <!-- Kit Information Section -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-box text-[#0D7A5F] mr-3"></i>
                    Kit Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Kit Code <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="kit_code" 
                               value="{{ old('kit_code', $kit->kit_code) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('kit_code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Collection Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="collection_date" 
                               value="{{ old('collection_date', $kit->collection_date ? $kit->collection_date->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('collection_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Patient Information Section -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user text-[#0D7A5F] mr-3"></i>
                    Patient Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="patient_name" 
                               value="{{ old('patient_name', $kit->patient->name) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('patient_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Date of Birth <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="patient_dob" 
                               value="{{ old('patient_dob', $kit->patient->date_of_birth->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('patient_dob')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            PIN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="patient_pin" 
                               value="{{ old('patient_pin', $kit->patient->pin) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('patient_pin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="patient_email" 
                               value="{{ old('patient_email', $kit->patient->email) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('patient_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="patient_phone" 
                               value="{{ old('patient_phone', $kit->patient->phone) }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0D7A5F] focus:border-transparent"
                               required>
                        @error('patient_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Ordered Tests Section -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-flask text-[#0D7A5F] mr-3"></i>
                    Ordered Tests
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" 
                               name="ordered_tests[]" 
                               value="Urinalysis"
                               {{ in_array('Urinalysis', $kit->ordered_tests) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#0D7A5F] rounded focus:ring-[#0D7A5F]">
                        <span class="font-medium text-gray-700">Urinalysis</span>
                    </label>
                    
                    <label class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" 
                               name="ordered_tests[]" 
                               value="Fecalysis"
                               {{ in_array('Fecalysis', $kit->ordered_tests) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#0D7A5F] rounded focus:ring-[#0D7A5F]">
                        <span class="font-medium text-gray-700">Fecalysis</span>
                    </label>
                    
                    <label class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" 
                               name="ordered_tests[]" 
                               value="Urine HCG"
                               {{ in_array('Urine HCG', $kit->ordered_tests) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#0D7A5F] rounded focus:ring-[#0D7A5F]">
                        <span class="font-medium text-gray-700">Urine HCG</span>
                    </label>
                </div>
                @error('ordered_tests')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Section (Read-only) -->
            <div class="mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-[#0D7A5F] mr-3"></i>
                    Kit Status
                </h2>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <span class="text-sm font-medium text-gray-600">Current Status:</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            @if($kit->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($kit->status == 'partial') bg-blue-100 text-blue-700
                            @elseif($kit->status == 'complete') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($kit->status) }}
                        </span>
                        <span class="text-xs text-gray-400 ml-auto">
                            Status is automatically updated when results are uploaded
                        </span>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('kits.index') }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#0D7A5F] text-white rounded-xl hover:bg-[#0a5e48] transition font-medium">
                    <i class="fas fa-save mr-2"></i> Update Kit
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>
    // Show error messages
    @foreach($errors->all() as $error)
        console.error('Validation error: {{ $error }}');
    @endforeach
</script>
@endif
@endsection