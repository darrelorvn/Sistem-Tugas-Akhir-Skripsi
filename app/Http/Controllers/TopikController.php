<?php

namespace App\Http\Controllers;

use App\Models\Topik;
use Illuminate\Http\Request;

class TopikController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $topiks = Topik::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('id', 'like', "%{$keyword}%")
                      ->orWhere('keywords', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama')
            ->get();

        return view('topik.index', compact('topiks', 'keyword'));
    }

    public function show(Topik $topik)
    {
        return view('topik.show', compact('topik'));
    }

    public function create()
    {
        return view('topik.create');
    }

    public function store(Request $request)
    {
        $request->merge(['id' => strtolower(trim($request->id ?? ''))]);

        $data = $request->validate([
            'id'          => ['required', 'regex:/^[a-z0-9_-]{1,50}$/', 'unique:topik,id'],
            'nama'        => ['required', 'string', 'max:255'],
            'topik_utama' => ['nullable', 'string'],
            'keywords'    => ['nullable', 'string'],
            'deskripsi'   => ['nullable', 'string'],
            'studi_kasus' => ['nullable', 'string'],
        ], [
            'id.required' => 'ID topik wajib diisi.',
            'id.regex'    => 'ID hanya boleh huruf kecil, angka, - dan _.',
            'id.unique'   => 'ID topik sudah dipakai.',
            'nama.required' => 'Nama topik wajib diisi.',
        ]);

        Topik::create(array_map(fn ($v) => $v ?? '', $data));

        return redirect()
            ->route('topik.index')
            ->with('success', 'Data topik & bidang minat berhasil ditambahkan.');
    }

    public function edit(Topik $topik)
    {
        return view('topik.edit', compact('topik'));
    }

    public function update(Request $request, Topik $topik)
    {
        $data = $request->validate([
            'nama'        => ['required', 'string', 'max:255'],
            'topik_utama' => ['nullable', 'string'],
            'keywords'    => ['nullable', 'string'],
            'deskripsi'   => ['nullable', 'string'],
            'studi_kasus' => ['nullable', 'string'],
        ], [
            'nama.required' => 'Nama topik wajib diisi.',
        ]);

        $topik->update(array_map(fn ($v) => $v ?? '', $data));

        return redirect()
            ->route('topik.index')
            ->with('success', 'Data topik & bidang minat berhasil diperbarui.');
    }

    public function destroy(Topik $topik)
    {
        $topik->delete();

        return redirect()
            ->route('topik.index')
            ->with('success', 'Data topik & bidang minat berhasil dihapus.');
    }
}
