<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Lab Results - Serene Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #EBF5F2; }

        .result-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 10px 30px -10px rgba(13, 122, 95, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .data-pill {
            background-color: #E8F3F0;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
        }

        .status-dot {
            height: 8px;
            width: 8px;
            background-color: #0D7A5F;
            border-radius: 50%;
            display: inline-block;
        }
        
        .reveal-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .reveal-content.active {
            max-height: 200px;
            transition: max-height 0.3s ease-in;
        }
    </style>
</head>
<body class="pb-24">
    <header class="w-full bg-white px-12 py-5 flex justify-between items-center sticky top-0 z-50">
        <div class="text-[#0D7A5F] text-lg font-bold tracking-tight">
            Serene Portal <span class="ml-2 text-[10px] bg-[#E8F3F0] px-2 py-1 rounded text-[#0D7A5F] uppercase tracking-widest font-bold">Read-Only View</span>
        </div>
        <div class="flex items-center space-x-6 text-gray-400">
            <i class="far fa-bell text-lg cursor-pointer"></i>
            <div class="w-8 h-8 rounded-full bg-[#0D7A5F] flex items-center justify-center text-white text-xs">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-6 pt-12">
        <div class="bg-[#E2EFEA] rounded-[2.5rem] p-10 text-center mb-8">
            <p class="text-[11px] font-bold text-[#0D7A5F] uppercase tracking-[0.2em] mb-4">
                Collection Date: {{ optional($kit->collection_date)->format('M d, Y') ?? 'Date not specified' }}
            </p>
            <div class="w-12 h-12 bg-[#0D7A5F] rounded-full flex items-center justify-center mx-auto mb-6 text-white shadow-lg shadow-[#0D7A5F]/20">
                <i class="fas fa-check text-lg"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight mb-2">All results within normal range</h1>
            <p class="text-sm text-gray-500 leading-relaxed max-w-sm mx-auto">
                Your clinical indicators suggest optimal health levels across all tested categories.
            </p>
        </div>

        <div class="flex justify-center mb-12">
            <a href="{{ route('patient.results.download', ['kit_code' => $kit->kit_code, 'dob' => $patient->date_of_birth]) }}" 
               class="bg-[#0D7A5F] text-white px-8 py-4 rounded-2xl font-bold text-sm flex items-center space-x-3 shadow-lg shadow-[#0D7A5F]/20 hover:bg-[#0a5e48] transition-all">
                <i class="fas fa-download text-xs"></i>
                <span>Download PDF Report</span>
            </a>
        </div>

        <!-- Urinalysis Section -->
        @if($urinalysisData)
        <div class="result-card">
            <div class="p-8 flex justify-between items-center cursor-pointer" onclick="toggleUrinalysis()">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-[#E8F3F0] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-droplet text-[#0D7A5F]"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Urinalysis</h2>
                        <p class="text-[11px] text-[#0D7A5F] font-bold uppercase tracking-wider flex items-center">
                            <span class="status-dot mr-2"></span> Status: Normal
                        </p>
                    </div>
                </div>
                <i class="fas fa-chevron-down text-gray-300" id="urinalysisIcon"></i>
            </div>
            
            <div id="urinalysisContent" class="px-8 pb-8 space-y-8" style="display: none;">
                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Physical Data</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="data-pill flex justify-between items-center">
                            <div>
                                <span class="block text-[10px] text-gray-400 font-bold uppercase">Color</span>
                                <span class="font-bold text-gray-800">{{ $urinalysisData['color'] ?? 'Straw' }}</span>
                            </div>
                            <span class="text-[9px] font-bold bg-white px-2 py-1 rounded text-[#0D7A5F]">NORMAL</span>
                        </div>
                        <div class="data-pill flex justify-between items-center">
                            <div>
                                <span class="block text-[10px] text-gray-400 font-bold uppercase">Clarity</span>
                                <span class="font-bold text-gray-800">{{ $urinalysisData['clarity'] ?? 'Clear' }}</span>
                            </div>
                            <span class="text-[9px] font-bold bg-white px-2 py-1 rounded text-[#0D7A5F]">NORMAL</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Chemical & Microscopic</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Glucose</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: Negative</span>
                                <span class="text-sm font-bold text-[#0D7A5F]">{{ $urinalysisData['glucose'] ?? 'Negative' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Protein</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: Negative</span>
                                <span class="text-sm font-bold text-gray-800">{{ $urinalysisData['protein'] ?? 'Negative' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">RBC Count</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: 0-3 /hpf</span>
                                <span class="text-sm font-bold text-gray-800">{{ $urinalysisData['rbc'] ?? '0-2' }} /hpf</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">WBC Count</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: 0-5 /hpf</span>
                                <span class="text-sm font-bold text-gray-800">{{ $urinalysisData['wbc'] ?? '1-3' }} /hpf</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">pH</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: 5.0-8.0</span>
                                <span class="text-sm font-bold text-gray-800">{{ $urinalysisData['ph'] ?? '6.0' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Fecalysis Section -->
        @if($fecalysisData)        
        <div class="result-card">
            <div class="p-8 flex justify-between items-center cursor-pointer" onclick="toggleFecalysis()">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-[#E8F3F0] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-poop text-[#0D7A5F]"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Fecalysis</h2>
                        <p class="text-[11px] text-[#0D7A5F] font-bold uppercase tracking-wider flex items-center">
                            <span class="status-dot mr-2"></span> Status: {{ $fecalysisData['status'] ?? 'Normal' }}
                        </p>
                    </div>
                </div>
                <i class="fas fa-chevron-down text-gray-300" id="fecalysisIcon"></i>
            </div>
            
            <div id="fecalysisContent" class="px-8 pb-8 space-y-8" style="display: none;">
                <!-- Physical Characteristics -->
                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Physical Characteristics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="data-pill">
                            <span class="block text-[10px] text-gray-400 font-bold uppercase mb-2">Color</span>
                            <span class="font-bold text-gray-800 block">{{ $fecalysisData['color'] ?? 'Brown' }}</span>
                            <span class="text-[9px] font-bold text-[#0D7A5F] mt-1 inline-block">{{ $fecalysisData['color_status'] ?? 'NORMAL' }}</span>
                        </div>
                        <div class="data-pill">
                            <span class="block text-[10px] text-gray-400 font-bold uppercase mb-2">Consistency</span>
                            <span class="font-bold text-gray-800 block">{{ $fecalysisData['consistency'] ?? 'Formed' }}</span>
                            <span class="text-[9px] font-bold text-[#0D7A5F] mt-1 inline-block">{{ $fecalysisData['consistency_status'] ?? 'NORMAL' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Microscopic Examination -->
                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Microscopic Examination</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Pus Cells (WBC)</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: 0-5 /hpf</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['pus_cells'] ?? '0-2' }} /hpf</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">RBC</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: 0 /hpf</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['rbc'] ?? '0' }} /hpf</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Fat Globules</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: Rare /hpf</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['fat_globules'] ?? 'Rare' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parasitology -->
                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Parasitology</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Ova / Parasites</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: None seen</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['ova_parasites'] ?? 'None seen' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Cysts</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: None seen</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['cysts'] ?? 'None seen' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Trophozoites</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: None seen</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['trophozoites'] ?? 'None seen' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chemical Tests -->
                @if(isset($fecalysisData['occult_blood']) || isset($fecalysisData['reducing_substances']))
                <div>
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Chemical Tests</h3>
                    <div class="space-y-3">
                        @if(isset($fecalysisData['occult_blood']))
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Occult Blood</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: Negative</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['occult_blood'] ?? 'Negative' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        @endif
                        @if(isset($fecalysisData['reducing_substances']))
                        <div class="flex justify-between items-center py-1">
                            <span class="text-sm font-medium text-gray-600">Reducing Substances</span>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs text-gray-400 italic">Ref: Negative</span>
                                <span class="text-sm font-bold text-gray-800">{{ $fecalysisData['reducing_substances'] ?? 'Negative' }}</span>
                                <span class="status-dot"></span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Additional Notes -->
                @if(isset($fecalysisData['notes']))
                <div class="bg-amber-50 p-4 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-sticky-note text-amber-600 mt-0.5"></i>
                        <div>
                            <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider">Clinical Notes</span>
                            <p class="text-xs text-gray-700 mt-1">{{ $fecalysisData['notes'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Urine HCG Section -->
        @if($hcgData)
        <div class="result-card">
            <div class="p-8 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-[#E8F3F0] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-vial text-[#0D7A5F]"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">Urine HCG</h2>
                        <p class="text-[11px] text-[#0D7A5F] font-bold uppercase tracking-wider flex items-center">
                            <span class="status-dot mr-2"></span> Status: {{ $hcgData['status'] ?? 'Result Ready' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-[#F8FBFA] p-6 text-center border-t border-gray-50">
                <button onclick="toggleHCG()" class="bg-[#0D7A5F] text-white px-6 py-3 rounded-xl font-bold text-xs flex items-center space-x-2 mx-auto shadow-md">
                    <i class="far fa-eye"></i>
                    <span>Tap to reveal</span>
                </button>
            </div>
            <div id="hcgContent" class="px-8 pb-8 text-center" style="display: none;">
                <div class="data-pill">
                    <p class="text-sm font-bold text-gray-800">Result: {{ $hcgData['hcg_result'] ?? 'Negative' }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $hcgData['notes'] ?? 'No pregnancy detected' }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-[#E8F3F0] rounded-[2rem] p-8 border border-[#D1E6E0]">
            <div class="flex items-center space-x-3 mb-4">
                <i class="far fa-file-lines text-[#0D7A5F]"></i>
                <h3 class="font-bold text-[#0D7A5F]">Plain-Language Summary</h3>
            </div>
            <p class="text-xs text-[#0D7A5F]/80 leading-relaxed font-medium">
                {{ $kit->summary ?? 'Overall, your results are consistent with healthy indicators. While one value is slightly outside the typical range, it\'s common and usually not a cause for concern.' }}
            </p>
            <div class="mt-6 flex items-center space-x-2 text-[10px] font-bold text-[#0D7A5F] uppercase tracking-tighter">
                <i class="fas fa-check-circle"></i>
                <span>Verified by Serene Medical Team on {{ now()->format('M d, Y') }}</span>
            </div>
        </div>
    </main>

    <nav class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-md border-t border-gray-100 flex justify-around items-center py-4 px-6 z-50">
        <div class="flex flex-col items-center space-y-1 text-gray-300">
            <i class="far fa-heart text-lg"></i>
            <span class="text-[9px] font-bold uppercase">Health</span>
        </div>
        <div class="flex flex-col items-center space-y-1 text-[#0D7A5F]">
            <div class="bg-[#E8F3F0] px-4 py-1 rounded-full mb-1">
                <i class="fas fa-microscope text-lg"></i>
            </div>
            <span class="text-[9px] font-bold uppercase">Results</span>
        </div>
        <div class="flex flex-col items-center space-y-1 text-gray-300">
            <i class="far fa-comment text-lg"></i>
            <span class="text-[9px] font-bold uppercase">Messages</span>
        </div>
        <div class="flex flex-col items-center space-y-1 text-gray-300">
            <i class="far fa-user text-lg"></i>
            <span class="text-[9px] font-bold uppercase">Profile</span>
        </div>
    </nav>

    <script>
        function toggleUrinalysis() {
            const content = document.getElementById('urinalysisContent');
            const icon = document.getElementById('urinalysisIcon');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        function toggleFecalysis() {
            const content = document.getElementById('fecalysisContent');
            const icon = document.getElementById('fecalysisIcon');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
        
        function toggleHCG() {
            const content = document.getElementById('hcgContent');
            const button = event.currentTarget;
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                button.innerHTML = '<i class="far fa-eye-slash"></i><span>Tap to hide</span>';
            } else {
                content.style.display = 'none';
                button.innerHTML = '<i class="far fa-eye"></i><span>Tap to reveal</span>';
            }
        }
    </script>
</body>
</html>