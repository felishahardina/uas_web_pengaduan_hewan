<?php

namespace App\Http\Controllers;

use App\Models\FelishaCategory;
use Illuminate\Http\Request;

class FelishaCategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = FelishaCategory::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:felisha_categories',
        ]);

        FelishaCategory::create($request->all());

        // PERBAIKAN: Menggunakan nama route 'admin.categories.index'
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(FelishaCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori di database.
     */
    public function update(Request $request, FelishaCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:felisha_categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        // PERBAIKAN: Menggunakan nama route 'admin.categories.index'
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(FelishaCategory $category)
    {
        $category->delete();

        // PERBAIKAN: Menggunakan nama route 'admin.categories.index'
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
