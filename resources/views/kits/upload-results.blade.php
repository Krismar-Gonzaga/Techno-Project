@extends('layouts.app')

@section('title', 'Upload Results - Serene Portal')

@section('content')
<div class="max-w-7xl mx-auto pb-24">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <div class="flex items-center space-x-2 text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">
                <span>Kit Management</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-[#0D7A5F]">Upload Results</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Test Kit {{ $kit->kit_code }}</h1>
            <p class="text-sm text-gray-500 mt-1 max-w-2xl">
                Enter diagnostic data for the patient's submitted samples. Ensure all fields are verified before releasing to the portal.
            </p>
        </div>
        
        <div class="flex space-x-3">
            <div class="bg-[#FFF8E6] px-4 py-2 rounded-xl text-center border border-[#FFEBC2]">
                <p class="text-[9px] uppercase font-bold text-[#B18414] tracking-tight">Status</p>
                <p class="text-xs font-bold text-[#D9A01B]">Pending Entry</p>
            </div>
            <div class="bg-[#E8F5F1] px-4 py-2 rounded-xl text-center border border-[#D1EBE3]">
                <p class="text-[9px] uppercase font-bold text-[#0D7A5F] tracking-tight">Patient ID</p>
                <p class="text-xs font-bold text-[#0D7A5F]">PT-4421-SM</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('kits.save-results', $kit->id) }}" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        
        <div class="lg:col-span-8 space-y-8">
            
            @if(in_array('Urinalysis', $kit->ordered_tests))
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-12 h-12 bg-[#E8F5F1] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-droplet text-[#0D7A5F] text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Urinalysis Form</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-2">Physical Analysis</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Color</label>
                                <select name="urinalysis[color]" class="w-full bg-[#F4F9F7] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                    <option>Straw</option>
                                    <option>Yellow</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Clarity</label>
                                <select name="urinalysis[clarity]" class="w-full bg-[#F4F9F7] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                    <option>Clear</option>
                                    <option>Cloudy</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-2">Chemical Analysis</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Glucose</label>
                                <select name="urinalysis[glucose]" class="w-full bg-[#F4F9F7] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                    <option>Negative</option>
                                    <option>Trace</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Protein</label>
                                <select name="urinalysis[protein]" class="w-full bg-[#F4F9F7] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                    <option>Negative</option>
                                    <option>Trace</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-4 mb-6">Microscopic Analysis</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-[#F4F9F7] rounded-xl p-4 flex items-center justify-between">
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-gray-400 uppercase">RBC Count</label>
                                <input type="text" name="urinalysis[rbc]" placeholder="cells/hpf" class="bg-transparent border-none p-0 text-sm w-full focus:ring-0">
                            </div>
                            <i class="fas fa-microscope text-gray-300 text-xs"></i>
                        </div>
                        <div class="bg-[#F4F9F7] rounded-xl p-4 flex items-center justify-between">
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-gray-400 uppercase">WBC Count</label>
                                <input type="text" name="urinalysis[wbc]" placeholder="cells/hpf" class="bg-transparent border-none p-0 text-sm w-full focus:ring-0">
                            </div>
                            <i class="fas fa-microscope text-gray-300 text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array('Fecalysis', $kit->ordered_tests))
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-12 h-12 bg-[#E8F5F1] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-poop text-[#0D7A5F] text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Fecalysis Form</h2>
                </div>

                <!-- Physical Characteristics -->
                <div class="mb-10">
                    <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-4 mb-6">Physical Characteristics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3">Color</label>
                            <select name="fecalysis[color]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                <option value="Brown" selected>Brown</option>
                                <option value="Yellow">Yellow</option>
                                <option value="Green">Green</option>
                                <option value="Black">Black</option>
                                <option value="Red">Red</option>
                                <option value="Pale/Clay">Pale/Clay</option>
                            </select>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-[9px] font-bold text-gray-400">Reference Range</span>
                                <span class="text-[9px] font-bold text-[#0D7A5F] bg-white px-2 py-0.5 rounded">NORMAL</span>
                            </div>
                        </div>
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3">Consistency</label>
                            <select name="fecalysis[consistency]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                <option value="Formed" selected>Formed</option>
                                <option value="Semi-formed">Semi-formed</option>
                                <option value="Soft">Soft</option>
                                <option value="Loose">Loose</option>
                                <option value="Watery">Watery</option>
                                <option value="Hard">Hard</option>
                            </select>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-[9px] font-bold text-gray-400">Reference Range</span>
                                <span class="text-[9px] font-bold text-[#0D7A5F] bg-white px-2 py-0.5 rounded">NORMAL</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Microscopic Examination -->
                <div class="mb-10">
                    <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-4 mb-6">Microscopic Examination</h3>
                    <div class="space-y-4">
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Pus Cells (WBC)</label>
                                    <select name="fecalysis[pus_cells]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="0-2 /hpf" selected>0-2 /hpf</option>
                                        <option value="3-5 /hpf">3-5 /hpf</option>
                                        <option value="6-10 /hpf">6-10 /hpf</option>
                                        <option value="11-20 /hpf">11-20 /hpf</option>
                                        <option value=">20 /hpf">&gt;20 /hpf</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">0-5 /hpf</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">RBC</label>
                                    <select name="fecalysis[rbc]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="0 /hpf" selected>0 /hpf</option>
                                        <option value="1-2 /hpf">1-2 /hpf</option>
                                        <option value="3-5 /hpf">3-5 /hpf</option>
                                        <option value="6-10 /hpf">6-10 /hpf</option>
                                        <option value=">10 /hpf">&gt;10 /hpf</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">0 /hpf</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Fat Globules</label>
                                    <select name="fecalysis[fat_globules]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="Rare" selected>Rare</option>
                                        <option value="Few">Few</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Many">Many</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">Rare /hpf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parasitology -->
                <div class="mb-10">
                    <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-4 mb-6">Parasitology</h3>
                    <div class="space-y-4">
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Ova / Parasites</label>
                                    <select name="fecalysis[ova_parasites]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="None seen" selected>None seen</option>
                                        <option value="Entamoeba histolytica">Entamoeba histolytica</option>
                                        <option value="Giardia lamblia">Giardia lamblia</option>
                                        <option value="Ascaris lumbricoides">Ascaris lumbricoides</option>
                                        <option value="Trichuris trichiura">Trichuris trichiura</option>
                                        <option value="Hookworm">Hookworm</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">None seen</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Cysts</label>
                                    <select name="fecalysis[cysts]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="None seen" selected>None seen</option>
                                        <option value="E. histolytica cysts">E. histolytica cysts</option>
                                        <option value="G. lamblia cysts">G. lamblia cysts</option>
                                        <option value="B. hominis">B. hominis</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">None seen</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-[#F4F9F7] rounded-xl p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Trophozoites</label>
                                    <select name="fecalysis[trophozoites]" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F]">
                                        <option value="None seen" selected>None seen</option>
                                        <option value="E. histolytica troph">E. histolytica troph</option>
                                        <option value="G. lamblia troph">G. lamblia troph</option>
                                        <option value="T. vaginalis">T. vaginalis</option>
                                    </select>
                                </div>
                                <div class="ml-4 text-right">
                                    <span class="text-[9px] font-bold text-gray-400 block">Reference Range</span>
                                    <span class="text-[9px] font-bold text-gray-500">None seen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes (Optional) -->
                <div>
                    <h3 class="text-xs font-bold text-[#4AA6EF] uppercase tracking-widest border-b border-gray-50 pb-4 mb-6">Clinical Notes</h3>
                    <div class="bg-[#F4F9F7] rounded-xl p-5">
                        <textarea name="fecalysis[notes]" rows="3" placeholder="Enter any additional clinical observations or remarks..." 
                            class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0D7A5F] resize-none"></textarea>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="lg:col-span-4 space-y-6">
            
            @if(in_array('Urine HCG', $kit->ordered_tests))
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-[#E8F5F1] rounded-xl flex items-center justify-center">
                        <i class="fas fa-person text-[#0D7A5F]"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">HCG Form</h2>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-6">Rapid Immunoassay Result</p>
                
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer group">
                        <input type="radio" name="hcg_result" value="positive" class="hidden peer">
                        <div class="border-2 border-gray-50 bg-white p-6 rounded-2xl text-center peer-checked:border-[#0D7A5F] peer-checked:bg-[#E8F5F1] transition">
                            <div class="w-8 h-8 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 peer-checked:bg-[#0D7A5F]">
                                <i class="fas fa-plus text-xs text-gray-400"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-500">Positive</span>
                        </div>
                    </label>
                    <label class="cursor-pointer group">
                        <input type="radio" name="hcg_result" value="negative" class="hidden peer" checked>
                        <div class="border-2 border-gray-50 bg-white p-6 rounded-2xl text-center peer-checked:border-[#0D7A5F] peer-checked:bg-[#E8F5F1] transition">
                            <div class="w-8 h-8 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-minus text-xs text-gray-400"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-500">Negative</span>
                        </div>
                    </label>
                </div>
            </div>
            @endif

            <div class="relative rounded-[2rem] overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&q=80&w=400" class="w-full h-64 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0D7A5F] via-[#0D7A5F]/40 to-transparent p-8 flex flex-col justify-end">
                    <p class="text-[9px] font-bold text-white/70 uppercase tracking-widest mb-1">Internal Check</p>
                    <h3 class="text-white font-bold text-xl mb-2">Kit {{ $kit->kit_code }} Stability</h3>
                    <p class="text-[11px] text-white/80 leading-relaxed">Sample verified as fresh and non-hemolyzed upon arrival.</p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-8 left-1/2 -translate-x-1/2 w-full max-w-4xl px-4 z-50">
            <div class="bg-white/80 backdrop-blur-md rounded-full shadow-2xl border border-white p-3 flex items-center justify-between">
                <div class="flex items-center ml-6">
                    <div class="w-6 h-6 bg-[#E8F5F1] rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check text-[#0D7A5F] text-[10px]"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-600">All fields are correctly formatted</span>
                </div>
                
                <button type="submit" class="bg-[#3B9E7E] hover:bg-[#2D7A61] text-white px-8 py-3.5 rounded-full font-bold text-sm flex items-center transition shadow-lg shadow-[#3b9e7e]/20">
                    Release Results to Patient <i class="fas fa-paper-plane ml-3 text-xs"></i>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection