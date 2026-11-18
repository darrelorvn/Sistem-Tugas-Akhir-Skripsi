<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\FasilitasRuang;
use App\Models\MasterRuang;
use App\Models\NomorGedung;
use App\Models\Topik;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RuangFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gedungs = ['Gedung A', 'Gedung B', 'Gedung D'];
        foreach ($gedungs as $gedung) {
            NomorGedung::firstOrCreate(['nama_gedung' => $gedung]);
        }

        $ruangs = [
            ['nama_ruang' => 'Ruang Sidang 1', 'gedung' => 'Gedung D'],
            ['nama_ruang' => 'Ruang Sidang 2', 'gedung' => 'Gedung D'],
        ];
        foreach ($ruangs as $ruang) {
            MasterRuang::firstOrCreate($ruang);
        }

        $fasilitas = [
            ['nama_ruang' => 'Ruang Sidang 1', 'proyektor' => 'Ada', 'pc' => 'Ada'],
            ['nama_ruang' => 'Ruang Sidang 2', 'proyektor' => 'Ada', 'pc' => 'Tidak Ada'],
            ['nama_ruang' => 'Ruang Sidang 3', 'proyektor' => 'Tidak Ada', 'pc' => 'Ada'],
        ];
        foreach ($fasilitas as $item) {
            FasilitasRuang::firstOrCreate(
                ['nama_ruang' => $item['nama_ruang']],
                ['proyektor' => $item['proyektor'], 'pc' => $item['pc']]
            );
        }

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Admin',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'              => 'User Biasa',
                'password'          => Hash::make('password'),
                'role'              => 'user',
                'email_verified_at' => now(),
            ]
        );

        $topiks = [
            [
                'id'          => 'ai',
                'nama'        => 'Artificial Intelligence & Machine Learning',
                'topik_utama' => 'Pengembangan model pembelajaran mesin dan kecerdasan buatan terapan',
                'keywords'    => 'Machine Learning, Deep Learning, NLP, Computer Vision',
                'deskripsi'   => 'Fokus pada penelitian algoritma cerdas, klasifikasi data, dan sistem rekomendasi.',
                'studi_kasus' => 'Deteksi dini penyakit berbasis citra medis',
            ],
            [
                'id'          => 'web',
                'nama'        => 'Rekayasa Perangkat Lunak & Web',
                'topik_utama' => 'Arsitektur sistem informasi web modern dan RESTful API',
                'keywords'    => 'Laravel, Microservices, REST API, Cloud',
                'deskripsi'   => 'Fokus pada perancangan sistem informasi skalabel, keamanan aplikasi web, dan integrasi API.',
                'studi_kasus' => 'Sistem Informasi Akademik Terintegrasi',
            ],
            [
                'id'          => 'cyber',
                'nama'        => 'Keamanan Siber & Jaringan',
                'topik_utama' => 'Analisis kerentanan sistem, kriptografi, dan keamanan jaringan',
                'keywords'    => 'Pentesting, Network Security, Cryptography, Forensics',
                'deskripsi'   => 'Fokus pada mitigasi serangan siber, audit keamanan aplikasi, dan proteksi data.',
                'studi_kasus' => 'Deteksi intrusi jaringan berbasis anomali',
            ],
        ];
        foreach ($topiks as $item) {
            Topik::firstOrCreate(['id' => $item['id']], $item);
        }

        $dosens = [
            [
                'nidn'       => '0412058801',
                'nama'       => 'Dr. Ahmad Fauzi, M.Kom.',
                'jabatan'    => 'Lektor Kepala',
                'kepakaran'  => 'Artificial Intelligence & Machine Learning',
                'email'      => 'ahmad.fauzi@kampus.ac.id',
                'pendidikan' => 'S3 Ilmu Komputer',
                'deskripsi'  => 'Pembimbing bidang kecerdasan buatan, NLP, dan data mining.',
            ],
            [
                'nidn'       => '0421099002',
                'nama'       => 'Siti Rahmawati, S.T., M.T.',
                'jabatan'    => 'Lektor',
                'kepakaran'  => 'Rekayasa Perangkat Lunak & Web',
                'email'      => 'siti.rahmawati@kampus.ac.id',
                'pendidikan' => 'S2 Teknik Informatika',
                'deskripsi'  => 'Pembimbing bidang arsitektur sistem informasi dan pengembangan aplikasi web.',
            ],
        ];
        foreach ($dosens as $d) {
            Dosen::firstOrCreate(['nidn' => $d['nidn']], $d);
        }
    }
}
