<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Patient;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PatientResultController extends Controller
{
    public function show(Request $request, $kit_code, $dob)
    {
        // Verify access token
        if (!$request->session()->has('access_token')) {
            abort(403, 'Unauthorized access. Please verify your credentials first.');
        }
        
        // Find the kit
        $kit = Kit::where('kit_code', $kit_code)->firstOrFail();
        
        // Find the patient
        $patient = Patient::findOrFail($kit->patient_id);
        
        // Get test results - FIXED: use 'results_data' instead of 'results'
        $testResults = TestResult::where('kit_id', $kit->id)->get();
        
        // Extract specific test results - FIXED: use 'results_data'
        $urinalysis = $testResults->where('test_type', 'urinalysis')->first();
        $hcg = $testResults->where('test_type', 'hcg')->first();
        $fecalysis = $testResults->where('test_type', 'fecalysis')->first(); // Added Fecalysis
        
        // Parse JSON data
        $urinalysisData = $urinalysis ? $urinalysis->results_data['urinalysis'] : null;
        $hcgData = $hcg ? $hcg->results_data : null;
        $fecalysisData = $fecalysis && isset($fecalysis->results_data['fecalysis']) ? $fecalysis->results_data['fecalysis'] : null; // Added Fecalysis data
        
        // Debug: Check if data exists
        \Log::info('Kit ID: ' . $kit->id);
        \Log::info('Test Results Count: ' . $testResults->count());
        \Log::info('Urinalysis Data: ', ['data' => $urinalysisData]);
        \Log::info('HCG Data: ', ['data' => $hcgData]);
        \Log::info('Fecalysis Data: ', ['data' => $fecalysisData]); // Added debug
        
        return view('patient.results', compact('kit', 'patient', 'urinalysisData', 'hcgData', 'fecalysisData'));
    }
    
    public function downloadPDF(Request $request, $kit_code, $dob)
    {
        
        
        // Find the kit
        $kit = Kit::where('kit_code', $kit_code)->firstOrFail();
        
        // Find the patient
        $patient = Patient::findOrFail($kit->patient_id);
        
        // Get test results
        $testResults = TestResult::where('kit_id', $kit->id)->get();
        
        // Extract specific test results
        $urinalysis = $testResults->where('test_type', 'urinalysis')->first();
        $hcg = $testResults->where('test_type', 'hcg')->first();
        $fecalysis = $testResults->where('test_type', 'fecalysis')->first(); // Added Fecalysis
        
        // Get the results data
        $urinalysisData = $urinalysis ? $urinalysis->results_data['urinalysis'] : null;
        $hcgData = $hcg ? $hcg->results_data : null;
        $fecalysisData = $fecalysis ? $fecalysis->results_data['fecalysis'] : null; // Added Fecalysis data
        
        // Load PDF view
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('patient.pdf-report', compact('kit', 'patient', 'urinalysisData', 'hcgData', 'fecalysisData'));
        
        return $pdf->download("lab-results-{$kit->kit_code}.pdf");
    }
}