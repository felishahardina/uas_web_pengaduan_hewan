<?php

namespace App\Http\Controllers;

use App\Models\FelishaAnimal;
use Illuminate\Http\Request;

class FelishaAnimalController extends Controller
{
    /**
     * Menampilkan daftar semua hewan untuk Admin.
     */
    public function index()
    {
        $animals = FelishaAnimal::with('category')->latest()->paginate(10);
        return view('admin.animals.index', compact('animals'));
    }

    // Method create, store, edit, update, destroy dihapus.
}
