<?php

namespace App\Http\Controllers;

use App\Models\MasterRuang;
use App\Models\NomorGedung;
use Illuminate\Http\Request;

class MasterRuangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $ruangs = MasterRuang::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_ruang', 'like', "%{$keyword}%")
                      ->orWhere('gedung', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('ruang.index', compact('ruangs', 'keyword'));
    }

    public function create()
    {
        $gedungs = NomorGedung::orderBy('nama_gedung')->get();

        return view('ruang.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'gedung'     => ['required', 'string', 'max:100'],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'gedung.required'     => 'Nama/Nomor gedung wajib diisi.',
        ]);

        MasterRuang::create($validated);

        return redirect()
            ->route('ruang.index')
            ->with('success', 'Data ruang sidang berhasil ditambahkan.');
    }

    public function edit(MasterRuang $ruang)
    {
        $gedungs = NomorGedung::orderBy('nama_gedung')->get();

        return view('ruang.edit', compact('ruang', 'gedungs'));
    }

    public function update(Request $request, MasterRuang $ruang)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'gedung'     => ['required', 'string', 'max:100'],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'gedung.required'     => 'Nama/Nomor gedung wajib diisi.',
        ]);

        $ruang->update($validated);

        return redirect()
            ->route('ruang.index')
            ->with('success', 'Data ruang sidang berhasil diperbarui.');
    }

    public function destroy(MasterRuang $ruang)
    {
        $ruang->delete();

        return redirect()
            ->route('ruang.index')
            ->with('success', 'Data ruang sidang berhasil dihapus.');
    }
}
