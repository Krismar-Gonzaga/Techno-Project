<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKits = Kit::count();
        $pendingResults = Kit::where('status', 'pending')->count();
        $completed = Kit::where('status', 'complete')->count();
        $released = Kit::where('status', 'released')->count();
        $recentKits = Kit::with('patient')->latest()->take(10)->get();

        $activeKits = Kit::whereIn('status', ['pending', 'partial'])->count();

        return view('dashboard', compact(
            'totalKits', 
            'pendingResults', 
            'completed', 
            'released', 
            'recentKits',
            'activeKits'
        ));
    }
}