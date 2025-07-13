<?php

namespace App\Http\Controllers;

use App\Models\FelishaAnimal;
use App\Models\FelishaCategory;
use App\Models\FelishaReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FelishaReportController extends Controller
{
    // =======================================
    // METHOD UNTUK PENGGUNA (USER)
    // =======================================

    /**
     * Menampilkan halaman dashboard untuk pengguna biasa.
     * Disederhanakan: tidak lagi mengirim data statistik.
     */
    public function userDashboard()
    {
        // PERBAIKAN: Mengambil 3 laporan terbaru yang sudah disetujui
        // untuk ditampilkan di dashboard pengguna.
        $latestApprovedReports = FelishaReport::where('status', 'approved')
            ->with('animal')
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact('latestApprovedReports'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru oleh user.
     */
    public function create()
    {
        // Hanya memuat data kategori yang diperlukan untuk form.
        $categories = FelishaCategory::orderBy('name')->get();
        return view('lapor', compact('categories'));
    }

    /**
     * Menyimpan laporan baru yang dibuat oleh user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'new_animal_name' => 'required|string|max:255',
            'jenis_kelamin' => ['required', Rule::in(['Jantan', 'Betina', 'Tidak Diketahui'])],
            'felisha_category_id' => 'required|exists:felisha_categories,id',
            'address' => 'required|string|min:10',
            'contact_phone' => 'required|string|max:20',
            'description' => 'required|string|min:10',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat data hewan baru terlebih dahulu
        $animal = FelishaAnimal::create([
            'name' => $request->input('new_animal_name'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'category_id' => $request->input('felisha_category_id'),
        ]);

        // Proses upload gambar
        $imagePath = $request->file('image_path')->store('reports', 'public');

        // Buat laporan utama
        FelishaReport::create([
            'user_id' => auth()->id(),
            'felisha_animal_id' => $animal->id,
            'address' => $request->input('address'),
            'contact_phone' => $request->input('contact_phone'),
            'description' => $request->input('description'),
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('laporan.saya')->with('success', 'Laporan Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    /**
     * Menampilkan riwayat laporan milik user yang sedang login.
     * Ditambahkan data statistik untuk ditampilkan di view.
     */
    public function userReports()
    {
        $user = Auth::user();

        // Mengambil data riwayat laporan dengan paginasi
        $reports = $user->reports()->with('animal')->latest()->paginate(9);

        // PERBAIKAN: Logika statistik dipindahkan ke sini.
        $totalLaporan = $user->reports()->count();
        $laporanPending = $user->reports()->where('status', 'pending')->count();
        $laporanApproved = $user->reports()->where('status', 'approved')->count();
        $laporanRejected = $user->reports()->where('status', 'rejected')->count();

        // Mengirim semua data (riwayat dan statistik) ke view
        return view('laporan-saya', compact(
            'reports', 
            'totalLaporan', 
            'laporanPending', 
            'laporanApproved',
            'laporanRejected'
        ));
    }
    
    // =======================================
    // METHOD UNTUK ADMIN
    // =======================================

    public function indexAdmin()
    {
        $reports = FelishaReport::with('user', 'animal.category')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    public function showAdmin(FelishaReport $report)
    {
        $report->load('user', 'animal.category');
        return view('admin.reports.show', compact('report'));
    }

    public function approve(FelishaReport $report)
    {
        $report->update(['status' => 'approved']);
        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil disetujui.');
    }

    public function reject(FelishaReport $report)
    {
        $report->update(['status' => 'rejected']);
        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil ditolak.');
    }

    public function destroyAdmin(FelishaReport $report)
    {
        if ($report->image_path && Storage::disk('public')->exists($report->image_path)) {
            Storage::disk('public')->delete($report->image_path);
        }
        
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}