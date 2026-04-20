@extends('layouts.app')

@section('title', 'Kit Management - Serene Portal')

@section('content')
<style>
    /* Action buttons styling */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        align-items: center;
    }

    .action-btn {
        transition: all 0.2s ease;
        cursor: pointer;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #f8fafc;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .action-btn.view:hover {
        color: #3b82f6 !important;
        background: #eff6ff;
    }

    .action-btn.edit:hover {
        color: #f59e0b !important;
        background: #fffbeb;
    }

    .action-btn.delete:hover {
        color: #ef4444 !important;
        background: #fef2f2;
    }

    .action-btn.upload:hover {
        color: #10b981 !important;
        background: #ecfdf5;
    }

    /* Delete confirmation modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 1.5rem;
        max-width: 400px;
        width: 90%;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>
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
<script>
    // Delete confirmation function
    function confirmDelete(kitId, kitCode) {
        // Create modal dynamically
        const modalHtml = `
            <div id="deleteModal" class="modal active">
                <div class="modal-content p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-trash-alt text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Delete Kit</h3>
                        <p class="text-gray-500 mb-6">
                            Are you sure you want to delete kit <span class="font-bold text-gray-800">${kitCode}</span>?<br>
                            This action cannot be undone.
                        </p>
                        <div class="flex space-x-3">
                            <button onclick="closeDeleteModal()" 
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button onclick="deleteKit('${kitId}')" 
                                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal if any
        const existingModal = document.getElementById('deleteModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    }
    
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.remove();
        }
    }
    
    function deleteKit(kitId) {
        // Create form for DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/kits/${kitId}`;
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add method spoofing for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection


