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
        
        $resultsData = $request->except('_token', 'test_type');
        
        $testResult = $kit->testResults()->create([
            'test_type' => $request->test_type,
            'results_data' => $resultsData,
        ]);

        // Update kit status if all tests are completed
        $completedTests = $kit->testResults->pluck('test_type')->toArray();
        $orderedTests = $kit->ordered_tests;
        
        if (count($completedTests) >= count($orderedTests)) {
            $kit->status = 'complete';
            $kit->save();
        } else {
            $kit->status = 'partial';
            $kit->save();
        }

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
}