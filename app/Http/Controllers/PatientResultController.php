<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Patient;
use App\Models\TestResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PatientResultController extends Controller
{
    public function show($kit_code, $dob)
    {
        // Find the kit
        $kit = Kit::where('kit_code', $kit_code)->first();
        
        if (!$kit) {
            abort(404, 'Results not found');
        }
        
        $patient = Patient::find($kit->patient_id);
        
        // Verify date of birth
        if ($patient->date_of_birth != $dob) {
            abort(403, 'Unauthorized access');
        }
        
        // Get test results
        $testResults = TestResult::where('kit_id', $kit->id)->get();
        
        // Parse results data
        $urinalysisData = null;
        $fecalysisData = null;
        $hcgData = null;
        
        foreach ($testResults as $result) {
            if (str_contains($result->test_type, 'Urinalysis')) {
                $urinalysisData = $result->results_data;
            } elseif (str_contains($result->test_type, 'Fecalysis')) {
                $fecalysisData = $result->results_data;
            } elseif (str_contains($result->test_type, 'HCG')) {
                $hcgData = $result->results_data;
            }
        }
        
        return view('patient.results', compact('kit', 'patient', 'urinalysisData', 'fecalysisData', 'hcgData'));
    }
    
    public function downloadPDF($kit_code, $dob)
    {
        // Find the kit
        $kit = Kit::where('kit_code', $kit_code)->first();
        
        if (!$kit) {
            abort(404, 'Results not found');
        }
        
        $patient = Patient::find($kit->patient_id);
        
        // Verify date of birth
        if ($patient->date_of_birth != $dob) {
            abort(403, 'Unauthorized access');
        }
        
        // Get test results
        $testResults = TestResult::where('kit_id', $kit->id)->get();
        
        // Parse results data
        $urinalysisData = null;
        $fecalysisData = null;
        $hcgData = null;
        
        foreach ($testResults as $result) {
            if (str_contains($result->test_type, 'Urinalysis')) {
                $urinalysisData = $result->results_data;
            } elseif (str_contains($result->test_type, 'Fecalysis')) {
                $fecalysisData = $result->results_data;
            } elseif (str_contains($result->test_type, 'HCG')) {
                $hcgData = $result->results_data;
            }
        }
        
        $pdf = PDF::loadView('patient.pdf-report', compact('kit', 'patient', 'urinalysisData', 'fecalysisData', 'hcgData'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('lab-results-' . $kit->kit_code . '.pdf');
    }
}