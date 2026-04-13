<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serene Portal - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        .bg-mint-gradient {
            background: radial-gradient(circle at center, #F0FAF7 0%, #E2F2ED 100%);
        }
    </style>
</head>
<body class="bg-mint-gradient min-h-screen flex flex-col">

    <x-header />

    <div class="flex-grow flex flex-col items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 w-full max-w-[440px] p-10 relative">
            
            <div class="text-center mb-8">
                <div class="w-12 h-12 bg-[#D1EBE3] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-microscope text-[#0D7A5F] text-xl"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-800">Login</h1>
                <p class="text-gray-500 text-sm mt-1">Please enter your email and password.</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-5">
                    <label class="block text-[#0D7A5F] text-[10px] font-bold mb-2 tracking-widest uppercase">Email</label>
                    <input type="email" name="email" placeholder="example@gmail.com"
                           class="w-full px-4 py-3 bg-[#E8F5F1] border-none rounded-lg focus:ring-2 focus:ring-[#0D7A5F] outline-none placeholder-gray-400 text-sm"
                           required>
                </div>
                
                <div class="mb-8">
                    <label class="block text-[#0D7A5F] text-[10px] font-bold mb-2 tracking-widest uppercase">Password</label>
                    <input type="password" name="password" placeholder="********"
                           class="w-full px-4 py-3 bg-[#E8F5F1] border-none rounded-lg focus:ring-2 focus:ring-[#0D7A5F] outline-none placeholder-gray-400 text-sm"
                           required>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#148F70] to-[#2D9F83] text-white font-medium py-3 rounded-lg hover:opacity-90 transition shadow-md flex items-center justify-center">
                    Login <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </button>
            </form>
            
            <div class="mt-10 text-center">
                <p class="text-[11px] text-gray-400 leading-relaxed px-4">
                    By accessing this portal, you agree to our <a href="#" class="underline">Privacy Policy</a> and <a href="#" class="underline">Terms of Service</a>.
                </p>
                
                <div class="mt-4 inline-flex items-center bg-[#D1EBE3] px-3 py-1.5 rounded-full">
                    <i class="fas fa-shield-check text-[#0D7A5F] text-[10px] mr-2"></i>
                    <span class="text-[#0D7A5F] text-[10px] font-bold uppercase tracking-tight">HIPAA Compliant Secure Connection</span>
                </div>
            </div>
        </div>

        <footer class="mt-12 text-[10px] text-gray-400 font-medium tracking-widest uppercase">
            Powered by Speckit Health Systems © 2024
        </footer>
    </div>
</body>
</html>