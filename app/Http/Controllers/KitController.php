<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KitController extends Controller
{
    public function index()
    {
        $kits = Kit::with('patient')->paginate(10);
        return view('kits.index', compact('kits'));
    }

    public function create()
    {
        return view('kits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kit_code' => 'required|unique:kits',
            
        ]);

        // Create or get patient
        $patient = Patient::create([
            'name' => $request->patient_name,
            'date_of_birth' => $request->patient_dob,
            'pin' => $request->patient_pin,
            'email' => $request->patient_email,
            'phone' => $request->patient_phone,
        ]);

        // Create kit
        $kit = Kit::create([
            'kit_code' => $request->kit_code,
            'patient_id' => $patient->id,
            'ordered_tests' => $request->ordered_tests,
            'collection_date' => $request->collection_date,
            'status' => 'pending',
        ]);

        return redirect()->route('kits.index')->with('success', 'Kit created successfully!');
    }

    public function generateKitCode()
    {
        $code = 'KIT-' . rand(1000, 9999) . '-' . Str::random(2);
        return response()->json(['kit_code' => $code]);
    }

    public function uploadResults($id)
    {
        $kit = Kit::with('patient')->findOrFail($id);
        return view('kits.upload-results', compact('kit'));
    }

    public function saveResults(Request $request, $id)
    {
        $kit = Kit::findOrFail($id);
        
        // Handle each test type separately
        $savedTests = [];
        
        // Check and save Urinalysis
        if (in_array('Urinalysis', $kit->ordered_tests) && $request->has('urinalysis')) {
            $savedTests[] = $kit->testResults()->create([
                'test_type' => 'urinalysis',
                'results_data' => $request->urinalysis,
            ]);
        }
        
        // Check and save Fecalysis
        if (in_array('Fecalysis', $kit->ordered_tests) && $request->has('fecalysis')) {
            $savedTests[] = $kit->testResults()->create([
                'test_type' => 'fecalysis',
                'results_data' => $request->fecalysis,
            ]);
        }
        
        // Check and save HCG
        if (in_array('Urine HCG', $kit->ordered_tests) && $request->has('hcg_result')) {
            $savedTests[] = $kit->testResults()->create([
                'test_type' => 'hcg',
                'results_data' => ['result' => $request->hcg_result],
            ]);
        }
        
        // Update kit status
        $completedTests = $kit->testResults->pluck('test_type')->toArray();
        $orderedTests = $kit->ordered_tests;
        
        if (count($completedTests) >= count($orderedTests)) {
            $kit->status = 'complete';
        } else {
            $kit->status = 'partial';
        }
        $kit->save();
        
        return redirect()->route('kits.index')->with('success', 'Results uploaded successfully!');
    }

    public function releaseResults($id)
    {
        $kit = Kit::findOrFail($id);
        $kit->status = 'released';
        $kit->save();

        // Update release timestamp for test results
        foreach ($kit->testResults as $result) {
            $result->released_at = now();
            $result->save();
        }

        return redirect()->route('kits.index')->with('success', 'Results released to patient portal!');
    }


    /**
     * View kit results (Eye button)
     */
    public function viewResults($id)
    {
        $kit = Kit::with(['patient', 'testResults'])->findOrFail($id);
        
        // Parse test results
        $urinalysisData = null;
        $fecalysisData = null;
        $hcgData = null;
        
        foreach ($kit->testResults as $result) {
            switch ($result->test_type) {
                case 'urinalysis':
                    $urinalysisData = $result->results_data;
                    break;
                case 'fecalysis':
                    $fecalysisData = $result->results_data;
                    break;
                case 'hcg':
                    $hcgData = $result->results_data;
                    break;
            }
        }
        
        return view('kits.view-results', compact('kit', 'urinalysisData', 'fecalysisData', 'hcgData'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $kit = Kit::with('patient')->findOrFail($id);
        return view('kits.edit', compact('kit'));
    }

    /**
     * Update kit
     */
    public function update(Request $request, $id)
    {
        $kit = Kit::findOrFail($id);
        
        $request->validate([
            'kit_code' => 'required|unique:kits,kit_code,' . $id,
            'patient_name' => 'required',
            'patient_dob' => 'required|date',
            'patient_pin' => 'required',
            'patient_email' => 'required|email',
            'patient_phone' => 'required',
            'ordered_tests' => 'required|array',
            'collection_date' => 'required|date',
        ]);
        
        // Update patient
        $kit->patient->update([
            'name' => $request->patient_name,
            'date_of_birth' => $request->patient_dob,
            'pin' => $request->patient_pin,
            'email' => $request->patient_email,
            'phone' => $request->patient_phone,
        ]);
        
        // Update kit
        $kit->update([
            'kit_code' => $request->kit_code,
            'ordered_tests' => $request->ordered_tests,
            'collection_date' => $request->collection_date,
        ]);
        
        return redirect()->route('kits.index')->with('success', 'Kit updated successfully!');
    }

    /**
     * Delete kit
     */
    public function destroy($id)
    {
        try {
            $kit = Kit::findOrFail($id);
            
            // Delete associated test results first
            $kit->testResults()->delete();
            
            // Delete the patient (optional - you might want to keep patient records)
            // $kit->patient()->delete();
            
            // Delete the kit
            $kit->delete();
            
            return redirect()->route('kits.index')->with('success', 'Kit deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('kits.index')->with('error', 'Error deleting kit: ' . $e->getMessage());
        }
    }
    
    
}