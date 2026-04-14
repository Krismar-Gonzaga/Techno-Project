<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PatientAccessController extends Controller
{
    public function showForm()
    {
        return view('patient.access-form');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'kit_code' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        // Find kit by kit_code
        $kit = Kit::where('kit_code', $request->kit_code)->first();
        
        if (!$kit) {
            return back()->withErrors(['kit_code' => 'Invalid kit code. Please check and try again.']);
        }

        // Verify date of birth
        $patient = Patient::find($kit->patient_id);
        
        if ($patient->date_of_birth != $request->date_of_birth) {
            return back()->withErrors(['date_of_birth' => 'Date of birth does not match our records.']);
        }

        // Check if results are released
        if ($kit->status !== 'released') {
            return back()->withErrors(['kit_code' => 'Results are not yet available. Please check back later.']);
        }

        // Generate encrypted token for secure access
        $token = Crypt::encryptString($kit->kit_code . '|' . $patient->date_of_birth);
        
        return redirect()->route('patient.results.show', [
            'kit_code' => $kit->kit_code,
            'dob' => $patient->date_of_birth
        ])->with('access_token', $token);
    }
}