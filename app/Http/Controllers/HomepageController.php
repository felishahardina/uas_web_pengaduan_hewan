<?php

namespace App\Http\Controllers;

use App\Models\FelishaReport;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar laporan yang disetujui.
     */
    public function index()
    {
        $reports = FelishaReport::where('status', 'approved')
            ->with('animal')
            ->latest()
            ->paginate(9); // Tampilkan 9 laporan per halaman
        return view('welcome', compact('reports'));
    }

    /**
     * Menampilkan halaman detail untuk satu laporan.
     */
    public function show(FelishaReport $report)
    {
        if ($report->status !== 'approved') {
            abort(404);
        }
        $report->load('user', 'animal.category');
        return view('laporan-detail', compact('report'));
    }
}
