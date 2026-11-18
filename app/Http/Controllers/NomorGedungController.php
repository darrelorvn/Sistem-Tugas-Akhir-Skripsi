<?php

namespace App\Http\Controllers;

use App\Models\NomorGedung;
use Illuminate\Http\Request;

class NomorGedungController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $gedungs = NomorGedung::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama_gedung', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('gedung.index', compact('gedungs', 'keyword'));
    }

    public function create()
    {
        return view('gedung.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gedung' => ['required', 'string', 'max:100'],
        ], [
            'nama_gedung.required' => 'Nama/Nomor gedung wajib diisi.',
        ]);

        NomorGedung::create($validated);

        return redirect()
            ->route('gedung.index')
            ->with('success', 'Data nomor gedung berhasil ditambahkan.');
    }

    public function edit(NomorGedung $gedung)
    {
        return view('gedung.edit', compact('gedung'));
    }

    public function update(Request $request, NomorGedung $gedung)
    {
        $validated = $request->validate([
            'nama_gedung' => ['required', 'string', 'max:100'],
        ], [
            'nama_gedung.required' => 'Nama/Nomor gedung wajib diisi.',
        ]);

        $gedung->update($validated);

        return redirect()
            ->route('gedung.index')
            ->with('success', 'Data nomor gedung berhasil diperbarui.');
    }

    public function destroy(NomorGedung $gedung)
    {
        $gedung->delete();

        return redirect()
            ->route('gedung.index')
            ->with('success', 'Data nomor gedung berhasil dihapus.');
    }
}
