@extends('layouts.app')

@section('title', 'Kit Management - Serene Portal')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-gray-800">All Laboratory Kits</h2>
                <p class="text-sm text-gray-500 mt-1">Manage and track all specimen kits</p>
            </div>
            <a href="{{ route('kits.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Create New Kit
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kit Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tests</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kits as $kit)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono text-sm">{{ $kit->kit_code }}</td>
                    <td class="px-6 py-4">{{ $kit->patient->name }}</td>
                    <td class="px-6 py-4">{{ $kit->patient->date_of_birth->format('Y-m-d') }}</td>
                    <td class="px-6 py-4">
                        <span class="status-badge 
                            @if($kit->status == 'pending') status-pending
                            @elseif($kit->status == 'partial') status-partial
                            @elseif($kit->status == 'complete') status-complete
                            @else status-released @endif">
                            {{ ucfirst($kit->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($kit->ordered_tests as $test)
                            <span class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $test }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end space-x-2">
                            <!-- View Result Eye Button -->
                            <a href="{{ route('kits.view-results', $kit->id) }}" 
                            class="text-gray-400 hover:text-blue-600 transition transform hover:scale-110 inline-block" 
                            title="View Results">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('kits.edit', $kit->id) }}" 
                            class="text-gray-400 hover:text-amber-600 transition transform hover:scale-110 inline-block" 
                            title="Edit Kit">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            
                            <!-- Delete Button -->
                            <button type="button" 
                                    onclick="confirmDelete('{{ $kit->id }}', '{{ $kit->kit_code }}')" 
                                    class="text-gray-400 hover:text-red-600 transition transform hover:scale-110 inline-block" 
                                    title="Delete Kit">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                            
                            <!-- Upload Results Button (if pending/partial) -->
                            @if(in_array($kit->status, ['pending', 'partial']))
                            <a href="{{ route('kits.upload-results', $kit->id) }}" 
                            class="text-gray-400 hover:text-green-600 transition transform hover:scale-110 inline-block" 
                            title="Upload Results">
                                <i class="fas fa-upload text-sm"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t">
        {{ $kits->links() }}
    </div>
</div>
@endsection