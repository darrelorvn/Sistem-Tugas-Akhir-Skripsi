<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRuang;
use App\Models\MasterRuang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FasilitasRuangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $fasilitas = FasilitasRuang::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama_ruang', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('fasilitas.index', compact('fasilitas', 'keyword'));
    }

    public function create()
    {
        $ruangs = MasterRuang::orderBy('nama_ruang')->get();

        return view('fasilitas.create', compact('ruangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'proyektor'  => ['required', Rule::in(['Ada', 'Tidak Ada'])],
            'pc'         => ['required', Rule::in(['Ada', 'Tidak Ada'])],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'proyektor.required'  => 'Status proyektor wajib dipilih.',
            'pc.required'         => 'Status PC wajib dipilih.',
        ]);

        FasilitasRuang::create($validated);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Data fasilitas ruang berhasil ditambahkan.');
    }

    public function edit(FasilitasRuang $fasilita)
    {
        $ruangs = MasterRuang::orderBy('nama_ruang')->get();

        return view('fasilitas.edit', [
            'fasilitas' => $fasilita,
            'ruangs'    => $ruangs,
        ]);
    }

    public function update(Request $request, FasilitasRuang $fasilita)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'proyektor'  => ['required', Rule::in(['Ada', 'Tidak Ada'])],
            'pc'         => ['required', Rule::in(['Ada', 'Tidak Ada'])],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'proyektor.required'  => 'Status proyektor wajib dipilih.',
            'pc.required'         => 'Status PC wajib dipilih.',
        ]);

        $fasilita->update($validated);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Data fasilitas ruang berhasil diperbarui.');
    }

    public function destroy(FasilitasRuang $fasilita)
    {
        $fasilita->delete();

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Data fasilitas ruang berhasil dihapus.');
    }
}
