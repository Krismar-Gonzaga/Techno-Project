<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Your Results - Serene Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        
        body {
            background-color: #EBF5F2;
        }

        .login-card {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
        }

        .custom-input {
            background-color: #E8F3F0;
            border: none;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            background-color: #E2EFEA;
            box-shadow: 0 0 0 2px rgba(13, 122, 95, 0.1);
        }
        
        .custom-input.error {
            border: 1px solid #ef4444;
            background-color: #fee2e2;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <x-header />

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-[440px] w-full">
            <div class="bg-white rounded-[2.5rem] login-card p-12 text-center">
                <div class="w-16 h-16 bg-[#E8F3F0] rounded-2xl flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-microscope text-[#0D7A5F] text-2xl"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 tracking-tight mb-3">Access Your Results</h1>
                <p class="text-[13px] text-gray-500 leading-relaxed mb-10 px-4">
                    Please enter your clinical details below to securely view your health data.
                </p>
                
                {{-- Display general error message (from session) --}}
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-left">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                
                {{-- Display validation errors --}}
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-left">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-red-700 mb-1">Please fix the following errors:</p>
                                <ul class="text-sm text-red-600 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('patient.access.verify') }}" class="space-y-6">
                    @csrf
                    
                    <div class="text-left">
                        <label class="block text-[10px] font-bold text-[#0D7A5F] uppercase tracking-widest mb-2 ml-1">Kit Code</label>
                        <div class="relative">
                            <i class="fas fa-qrcode absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" 
                                   name="kit_code" 
                                   value="{{ old('kit_code') }}"
                                   placeholder="e.g. SK-882-941"
                                   class="w-full pl-11 pr-4 py-4 custom-input rounded-2xl text-sm placeholder:text-gray-400 outline-none @error('kit_code') error @enderror"
                                   required>
                        </div>
                        @error('kit_code')
                            <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="text-left">
                        <label class="block text-[10px] font-bold text-[#0D7A5F] uppercase tracking-widest mb-2 ml-1">Date of Birth</label>
                        <div class="relative">
                            <i class="far fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" 
                                   name="date_of_birth" 
                                   value="{{ old('date_of_birth') }}"
                                   placeholder="mm/dd/yyyy"
                                   onfocus="(this.type='date')"
                                   class="w-full pl-11 pr-4 py-4 custom-input rounded-2xl text-sm placeholder:text-gray-400 outline-none @error('date_of_birth') error @enderror"
                                   required>
                        </div>
                        @error('date_of_birth')
                            <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-[#309A78] hover:bg-[#267C61] text-white py-4 rounded-2xl transition-all duration-300 font-bold text-sm flex items-center justify-center space-x-2 shadow-lg shadow-[#309A78]/20 mt-8">
                        <span>View My Results</span>
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </button>
                </form>
                
                <div class="mt-10 pt-8 border-t border-gray-50">
                    <p class="text-[11px] text-gray-400 leading-relaxed">
                        By accessing this portal, you agree to our 
                        <a href="#" class="text-[#0D7A5F] font-semibold hover:underline">Privacy Policy</a> and 
                        <a href="#" class="text-[#0D7A5F] font-semibold hover:underline">Terms of Service</a>.
                    </p>
                    <div class="mt-5 inline-flex items-center space-x-2 bg-[#E8F3F0] px-4 py-2 rounded-full">
                        <i class="fas fa-check-shield text-[#0D7A5F] text-[10px]"></i>
                        <span class="text-[10px] font-bold text-[#0D7A5F] uppercase tracking-tight">HIPAA Compliant Secure Connection</span>
                    </div>
                </div>
            </div>
            
            <footer class="text-center mt-12">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Powered by Specikit Health Systems © 2026</p>
            </footer>
        </div>
    </main>
</body>
</html>