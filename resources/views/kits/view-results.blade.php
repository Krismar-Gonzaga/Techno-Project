@extends('layouts.app')

@section('title', 'View Results - ' . $kit->kit_code)

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">
                <span>Kit Management</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-[#0D7A5F]">View Results</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Test Results: {{ $kit->kit_code }}</h1>
            <p class="text-sm text-gray-500 mt-1">Patient: {{ $kit->patient->name }}</p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('kits.upload-results', $kit->id) }}" 
               class="bg-[#0D7A5F] text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-[#0a5e48] transition">
                <i class="fas fa-upload mr-2"></i> Upload New Results
            </a>
            <a href="{{ route('kits.index') }}" 
               class="border border-gray-300 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    @if($kit->testResults->isEmpty())
        <div class="bg-white rounded-2xl p-12 text-center">
            <i class="fas fa-flask text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Results Available</h3>
            <p class="text-gray-500">No test results have been uploaded for this kit yet.</p>
            <a href="{{ route('kits.upload-results', $kit->id) }}" 
               class="inline-block mt-4 bg-[#0D7A5F] text-white px-6 py-2 rounded-xl">
                Upload Results
            </a>
        </div>
    @else
        <!-- Display Urinalysis Results -->
        @if($urinalysisData)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-[#E8F5F1] rounded-2xl flex items-center justify-center">
                    <i class="fas fa-droplet text-[#0D7A5F] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Urinalysis Results</h2>
                    <p class="text-xs text-gray-500">Test performed on {{ $kit->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($urinalysisData as $key => $value)
                <div class="bg-gray-50 rounded-xl p-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                    <p class="text-lg font-bold text-gray-800 mt-1">{{ $value }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Display Fecalysis Results -->
        @if($fecalysisData)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-[#E8F5F1] rounded-2xl flex items-center justify-center">
                    <i class="fas fa-poop text-[#0D7A5F] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Fecalysis Results</h2>
                    <p class="text-xs text-gray-500">Test performed on {{ $kit->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($fecalysisData as $key => $value)
                <div class="bg-gray-50 rounded-xl p-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                    <p class="text-lg font-bold text-gray-800 mt-1">{{ $value }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Display HCG Results -->
        @if($hcgData)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-[#E8F5F1] rounded-2xl flex items-center justify-center">
                    <i class="fas fa-vial text-[#0D7A5F] text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Urine HCG Results</h2>
                    <p class="text-xs text-gray-500">Test performed on {{ $kit->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <span class="text-[10px] font-bold text-gray-400 uppercase">Result</span>
                <p class="text-2xl font-bold {{ $hcgData['result'] == 'positive' ? 'text-green-600' : 'text-gray-800' }} mt-1">
                    {{ ucfirst($hcgData['result'] ?? 'Not specified') }}
                </p>
            </div>
        </div>
        @endif
    @endif
</div>
@endsection