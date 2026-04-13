@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">KIT MANAGEMENT > UPLOAD RESULTS</h1>
        <p class="text-gray-600 mt-2">Test Kit: <span class="font-mono font-bold">{{ $kit->kit_code }}</span></p>
        <p class="text-gray-600">Enter diagnostic data for the patient's submitted samples. Ensure all fields are verified before releasing to the portal.</p>
    </div>

    <form method="POST" action="{{ route('kits.save-results', $kit->id) }}" class="space-y-6">
        @csrf
        
        @if(in_array('Urinalysis', $kit->ordered_tests))
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Urinalysis Form</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-bold mb-4">Physical Analysis</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium">Color</label>
                                <select name="urinalysis[color]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Straw</option>
                                    <option>Yellow</option>
                                    <option>Amber</option>
                                    <option>Dark Yellow</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Clarity</label>
                                <select name="urinalysis[clarity]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Clear</option>
                                    <option>Slightly Cloudy</option>
                                    <option>Cloudy</option>
                                    <option>Turbid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-4">Chemical Analysis</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium">Glucose</label>
                                <select name="urinalysis[glucose]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Negative</option>
                                    <option>Trace</option>
                                    <option>1+</option>
                                    <option>2+</option>
                                    <option>3+</option>
                                    <option>4+</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Protein</label>
                                <select name="urinalysis[protein]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Negative</option>
                                    <option>Trace</option>
                                    <option>1+</option>
                                    <option>2+</option>
                                    <option>3+</option>
                                    <option>4+</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h3 class="font-bold mb-4">Microscopic Analysis</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">RBC COUNT (cells/hpf)</label>
                            <input type="text" name="urinalysis[rbc]" class="w-full px-3 py-2 border rounded-lg mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">WBC COUNT (cells/hpf)</label>
                            <input type="text" name="urinalysis[wbc]" class="w-full px-3 py-2 border rounded-lg mt-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('Fecalysis', $kit->ordered_tests))
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Feacalysis Form</h2>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="font-bold mb-3">MACROSCOPIC</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium">CONSISTENCY</label>
                                <select name="fecalysis[consistency]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Soft</option>
                                    <option>Formed</option>
                                    <option>Hard</option>
                                    <option>Loose</option>
                                    <option>Watery</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">COLOR</label>
                                <select name="fecalysis[color]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Brown</option>
                                    <option>Clay</option>
                                    <option>Yellow</option>
                                    <option>Green</option>
                                    <option>Black</option>
                                    <option>Red</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-3">PARASITOLOGY</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium">OVA OR PARASITES</label>
                                <select name="fecalysis[ova_parasites]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>None Seen</option>
                                    <option>Present</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">PROTOZOA</label>
                                <select name="fecalysis[protozoa]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>None Seen</option>
                                    <option>Present</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-3">OBSERVATIONS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium">OCCULT BLOOD</label>
                                <select name="fecalysis[occult_blood]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>Negative</option>
                                    <option>Positive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">FAT GLOBULES</label>
                                <select name="fecalysis[fat_globules]" class="w-full px-3 py-2 border rounded-lg mt-1">
                                    <option>None</option>
                                    <option>Few</option>
                                    <option>Moderate</option>
                                    <option>Many</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <input type="hidden" name="test_type" value="{{ implode(',', $kit->ordered_tests) }}">
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold">
                Release Results to Patient
            </button>
        </div>
    </form>
</div>
@endsection