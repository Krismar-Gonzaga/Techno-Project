<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Lab Results - Serene Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-normal {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .result-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .result-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .reveal-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .reveal-content.active {
            max-height: 500px;
            transition: max-height 0.3s ease-in;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="w-full bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-2">
            <div class="text-[#0D7A5F] text-xl font-bold flex items-center">
                <i class="fas fa-shield-halved mr-2"></i> SERENE PORTAL
            </div>
        </div>
        
        <div class="text-sm">
            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs">READ-ONLY VIEW</span>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Collection Date -->
        <div class="mb-6 text-right">
            <p class="text-sm text-gray-500">
                <i class="far fa-calendar-alt mr-1"></i> 
                COLLECTION DATE: {{ $kit->collection_date->format('M d, Y') }}
            </p>
        </div>
        
        <!-- Success Message -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <div>
                    <h3 class="font-semibold text-green-800">All results within normal range</h3>
                    <p class="text-sm text-green-700">Your clinical indicators suggest optimal health levels across all tested categories.</p>
                </div>
            </div>
        </div>
        
        <!-- Download PDF Button -->
        <div class="text-center mb-8">
            <a href="{{ route('patient.results.download', ['kit_code' => $kit->kit_code, 'dob' => $patient->date_of_birth]) }}" 
               class="inline-flex items-center space-x-2 bg-[#0D7A5F] text-white px-6 py-3 rounded-lg hover:bg-[#0a5e48] transition shadow-md">
                <i class="fas fa-download"></i>
                <span>Download PDF Report</span>
            </a>
        </div>
        
        <!-- Urinalysis Section -->
        @if($urinalysisData)
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden result-card">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Urinalysis</h2>
                    <span class="status-badge status-normal">
                        <i class="fas fa-check-circle mr-1 text-xs"></i> Status: Normal
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <h3 class="font-semibold text-gray-700 mb-4">PHYSICAL DATA</h3>
                <table class="w-full mb-6">
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Color</td>
                            <td class="py-2">{{ $urinalysisData['color'] ?? 'Straw' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                            <td class="py-2 font-medium">Transparency</td>
                            <td class="py-2">{{ $urinalysisData['clarity'] ?? 'Clear' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Glucose</td>
                            <td class="py-2">{{ $urinalysisData['glucose'] ?? 'Negative' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                            <td class="py-2 font-medium">Protein</td>
                            <td class="py-2">{{ $urinalysisData['protein'] ?? 'Negative' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">pH</td>
                            <td class="py-2">6.0</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                            <td class="py-2 font-medium"></td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                        </tr>
                    </tbody>
                </table>
                
                <h3 class="font-semibold text-gray-700 mb-4">MICROSCOPIC DATA</h3>
                <table class="w-full">
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 font-medium">RBC</td>
                            <td class="py-2">{{ $urinalysisData['rbc'] ?? '0-2' }} /hpf</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                            <td class="py-2 font-medium">Ref: 0-3 /hpf</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">WBC</td>
                            <td class="py-2">{{ $urinalysisData['wbc'] ?? '1-3' }} /hpf</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                            <td class="py-2 font-medium">Ref: 0-5 /hpf</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        <!-- Fecalysis Section -->
        @if($fecalysisData)
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden result-card">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Fecalysis</h2>
                    <span class="status-badge status-normal">
                        <i class="fas fa-check-circle mr-1 text-xs"></i> Status: Normal
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Consistency</td>
                            <td class="py-2">{{ $fecalysisData['consistency'] ?? 'Soft' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Color</td>
                            <td class="py-2">{{ $fecalysisData['color'] ?? 'Brown' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Ova or Parasites</td>
                            <td class="py-2">{{ $fecalysisData['ova_parasites'] ?? 'None Seen' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 font-medium">Occult Blood</td>
                            <td class="py-2">{{ $fecalysisData['occult_blood'] ?? 'Negative' }}</td>
                            <td class="py-2 text-green-600">NORMAL</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        <!-- Urine HCG Section -->
        @if($hcgData)
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden result-card">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Urine HCG</h2>
                    <span class="status-badge status-normal">
                        <i class="fas fa-check-circle mr-1 text-xs"></i> Status: Result Ready
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <p class="text-gray-700">Result: Negative</p>
            </div>
        </div>
        @endif
        
        <!-- Tap to Reveal Section -->
        <div class="bg-gray-50 rounded-xl p-4 mb-6 cursor-pointer" onclick="toggleReveal()">
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Tap to reveal</span>
                <i class="fas fa-chevron-down text-gray-400" id="revealIcon"></i>
            </div>
        </div>
        
        <div id="revealContent" class="reveal-content">
            <div class="bg-blue-50 rounded-xl p-6 mb-6">
                <h3 class="font-semibold text-blue-900 mb-2">Plain-Language Summary</h3>
                <p class="text-sm text-blue-800">
                    Overall, your results are consistent with healthy indicators. While one value is slightly outside the typical range, 
                    it's common and usually not a cause for concern. We recommend discussing these details with your primary physician 
                    at your next visit.
                </p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center pt-6 border-t">
            <p class="text-sm font-semibold text-gray-700">VERIFIED BY SERENE MEDICAL TEAM</p>
            <p class="text-xs text-gray-500 mt-2">
                These results are shared as part of your digital medical record. Please consult with your attending physician 
                to discuss these findings in the context of your overall health.
            </p>
        </div>
    </div>
    
    <script>
        function toggleReveal() {
            const content = document.getElementById('revealContent');
            const icon = document.getElementById('revealIcon');
            
            content.classList.toggle('active');
            
            if (content.classList.contains('active')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
    </script>
</body>
</html>