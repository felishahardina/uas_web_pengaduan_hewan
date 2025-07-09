<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FelishaAnimal;
use App\Models\FelishaCategory;
use App\Models\FelishaReport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pindahkan semua logika pengambilan data ke sini
        $totalReports = FelishaReport::count();
        $totalAnimals = FelishaAnimal::count();
        $totalCategories = FelishaCategory::count();
        $latestReports = FelishaReport::with('user', 'animal', 'location')
                                      ->latest()
                                      ->take(5)
                                      ->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalReports',
            'totalAnimals',
            'totalCategories',
            'latestReports'
        ));
    }
}
