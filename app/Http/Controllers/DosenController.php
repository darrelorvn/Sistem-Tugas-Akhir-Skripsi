<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $dosens = Dosen::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nidn', 'like', "%{$keyword}%")
                      ->orWhere('kepakaran', 'like', "%{$keyword}%")
                      ->orWhere('jabatan', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama')
            ->get();

        return view('dosen.index', compact('dosens', 'keyword'));
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nidn'       => ['required', 'string', 'max:30', 'unique:dosen_bimbingan,nidn'],
            'nama'       => ['required', 'string', 'max:255'],
            'foto'       => ['nullable', 'string', 'max:255'],
            'jabatan'    => ['nullable', 'string', 'max:100'],
            'kepakaran'  => ['nullable', 'string', 'max:255'],
            'email'      => ['nullable', 'email', 'max:255'],
            'pendidikan' => ['nullable', 'string', 'max:255'],
            'deskripsi'  => ['nullable', 'string'],
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique'   => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'email.email'   => 'Format email tidak valid.',
        ]);

        Dosen::create($data);

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen pembimbing berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'nama'       => ['required', 'string', 'max:255'],
            'foto'       => ['nullable', 'string', 'max:255'],
            'jabatan'    => ['nullable', 'string', 'max:100'],
            'kepakaran'  => ['nullable', 'string', 'max:255'],
            'email'      => ['nullable', 'email', 'max:255'],
            'pendidikan' => ['nullable', 'string', 'max:255'],
            'deskripsi'  => ['nullable', 'string'],
        ], [
            'nama.required' => 'Nama dosen wajib diisi.',
            'email.email'   => 'Format email tidak valid.',
        ]);

        $dosen->update($data);

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen pembimbing berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen pembimbing berhasil dihapus.');
    }
}
