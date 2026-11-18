<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\FasilitasRuang;
use App\Models\MasterRuang;
use App\Models\NomorGedung;
use App\Models\Topik;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RuangFasilitasTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function regularUser(): User
    {
        return User::factory()->create(['role' => 'user']);
    }

    public function test_admin_can_crud_master_ruang(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)->get(route('ruang.index'))->assertOk();
        $this->actingAs($admin)->get(route('ruang.create'))->assertOk();

        $this->actingAs($admin)
            ->post(route('ruang.store'), [
                'nama_ruang' => 'Ruang Sidang 1',
                'gedung'     => 'Gedung D',
            ])
            ->assertRedirect(route('ruang.index'));

        $ruang = MasterRuang::firstOrFail();
        $this->assertSame('Ruang Sidang 1', $ruang->nama_ruang);

        $this->actingAs($admin)
            ->put(route('ruang.update', $ruang), [
                'nama_ruang' => 'Ruang Sidang Utama',
                'gedung'     => 'Gedung A',
            ])
            ->assertRedirect(route('ruang.index'));

        $this->assertDatabaseHas('master_ruang', [
            'id'         => $ruang->id,
            'nama_ruang' => 'Ruang Sidang Utama',
            'gedung'     => 'Gedung A',
        ]);

        $this->actingAs($admin)
            ->delete(route('ruang.destroy', $ruang))
            ->assertRedirect(route('ruang.index'));

        $this->assertDatabaseMissing('master_ruang', ['id' => $ruang->id]);
    }

    public function test_admin_can_crud_nomor_gedung(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->post(route('gedung.store'), ['nama_gedung' => 'Gedung B'])
            ->assertRedirect(route('gedung.index'));

        $gedung = NomorGedung::firstOrFail();

        $this->actingAs($admin)
            ->put(route('gedung.update', $gedung), ['nama_gedung' => 'Gedung C'])
            ->assertRedirect(route('gedung.index'));

        $this->assertDatabaseHas('nomor_gedung', ['id' => $gedung->id, 'nama_gedung' => 'Gedung C']);

        $this->actingAs($admin)
            ->delete(route('gedung.destroy', $gedung))
            ->assertRedirect(route('gedung.index'));

        $this->assertDatabaseMissing('nomor_gedung', ['id' => $gedung->id]);
    }

    public function test_admin_can_crud_fasilitas_ruang(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->post(route('fasilitas.store'), [
                'nama_ruang' => 'Ruang Sidang 2',
                'proyektor'  => 'Ada',
                'pc'         => 'Tidak Ada',
            ])
            ->assertRedirect(route('fasilitas.index'));

        $fasilitas = FasilitasRuang::firstOrFail();

        $this->actingAs($admin)
            ->put(route('fasilitas.update', $fasilitas), [
                'nama_ruang' => 'Ruang Sidang 2',
                'proyektor'  => 'Ada',
                'pc'         => 'Ada',
            ])
            ->assertRedirect(route('fasilitas.index'));

        $this->assertDatabaseHas('fasilitas_ruang', [
            'id' => $fasilitas->id,
            'pc' => 'Ada',
        ]);

        $this->actingAs($admin)
            ->delete(route('fasilitas.destroy', $fasilitas))
            ->assertRedirect(route('fasilitas.index'));

        $this->assertDatabaseMissing('fasilitas_ruang', ['id' => $fasilitas->id]);
    }

    public function test_regular_user_can_view_but_cannot_modify_modules(): void
    {
        $user = $this->regularUser();
        $ruang = MasterRuang::create(['nama_ruang' => 'Ruang 1', 'gedung' => 'Gedung A']);
        $gedung = NomorGedung::create(['nama_gedung' => 'Gedung A']);
        $fasilitas = FasilitasRuang::create([
            'nama_ruang' => 'Ruang 1',
            'proyektor'  => 'Ada',
            'pc'         => 'Ada',
        ]);

        $this->actingAs($user)->get(route('ruang.index'))->assertOk();
        $this->actingAs($user)->get(route('gedung.index'))->assertOk();
        $this->actingAs($user)->get(route('fasilitas.index'))->assertOk();

        $this->actingAs($user)->get(route('ruang.create'))->assertForbidden();
        $this->actingAs($user)->post(route('ruang.store'), ['nama_ruang' => 'X', 'gedung' => 'Y'])->assertForbidden();
        $this->actingAs($user)->delete(route('ruang.destroy', $ruang))->assertForbidden();

        $this->actingAs($user)->get(route('gedung.create'))->assertForbidden();
        $this->actingAs($user)->delete(route('gedung.destroy', $gedung))->assertForbidden();

        $this->actingAs($user)->get(route('fasilitas.create'))->assertForbidden();
        $this->actingAs($user)->delete(route('fasilitas.destroy', $fasilitas))->assertForbidden();

        $topik = Topik::create(['id' => 'ai', 'nama' => 'AI']);
        $this->actingAs($user)->get(route('topik.index'))->assertOk();
        $this->actingAs($user)->get(route('topik.show', $topik))->assertOk();
        $this->actingAs($user)->get(route('topik.create'))->assertForbidden();
        $this->actingAs($user)->post(route('topik.store'), ['id' => 'ml', 'nama' => 'ML'])->assertForbidden();
        $this->actingAs($user)->delete(route('topik.destroy', $topik))->assertForbidden();

        $dosen = Dosen::create(['nidn' => '010101', 'nama' => 'Dosen Test']);
        $this->actingAs($user)->get(route('dosen.index'))->assertOk();
        $this->actingAs($user)->get(route('dosen.show', $dosen))->assertOk();
        $this->actingAs($user)->get(route('dosen.create'))->assertForbidden();
        $this->actingAs($user)->post(route('dosen.store'), ['nidn' => '020202', 'nama' => 'Dosen 2'])->assertForbidden();
        $this->actingAs($user)->delete(route('dosen.destroy', $dosen))->assertForbidden();
    }

    public function test_admin_can_crud_dosen(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)->get(route('dosen.index'))->assertOk();
        $this->actingAs($admin)->get(route('dosen.create'))->assertOk();

        $this->actingAs($admin)
            ->post(route('dosen.store'), [
                'nidn'       => '0412058899',
                'nama'       => 'Dr. Budi Santoso',
                'jabatan'    => 'Lektor',
                'kepakaran'  => 'Cloud Computing',
                'email'      => 'budi@kampus.ac.id',
                'pendidikan' => 'S3 Informatika',
                'deskripsi'  => 'Ahli sistem terdistribusi',
            ])
            ->assertRedirect(route('dosen.index'));

        $dosen = Dosen::findOrFail('0412058899');
        $this->actingAs($admin)->get(route('dosen.show', $dosen))->assertOk();

        $this->actingAs($admin)
            ->put(route('dosen.update', $dosen), [
                'nama'    => 'Prof. Dr. Budi Santoso',
                'jabatan' => 'Guru Besar',
            ])
            ->assertRedirect(route('dosen.index'));

        $this->assertDatabaseHas('dosen_bimbingan', [
            'nidn'    => '0412058899',
            'nama'    => 'Prof. Dr. Budi Santoso',
            'jabatan' => 'Guru Besar',
        ]);

        $this->actingAs($admin)
            ->delete(route('dosen.destroy', $dosen))
            ->assertRedirect(route('dosen.index'));

        $this->assertDatabaseMissing('dosen_bimbingan', ['nidn' => '0412058899']);
    }

    public function test_admin_can_crud_topik(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)->get(route('topik.index'))->assertOk();
        $this->actingAs($admin)->get(route('topik.create'))->assertOk();

        $this->actingAs($admin)
            ->post(route('topik.store'), [
                'id'          => 'rpl',
                'nama'        => 'Rekayasa Perangkat Lunak',
                'topik_utama' => 'Arsitektur Web',
                'keywords'    => 'Laravel, API',
                'deskripsi'   => 'Fokus web modern',
                'studi_kasus' => 'Sistem Akademik',
            ])
            ->assertRedirect(route('topik.index'));

        $topik = Topik::findOrFail('rpl');
        $this->actingAs($admin)->get(route('topik.show', $topik))->assertOk();

        $this->actingAs($admin)
            ->put(route('topik.update', $topik), [
                'nama'        => 'RPL & Cloud',
                'topik_utama' => 'Microservices',
            ])
            ->assertRedirect(route('topik.index'));

        $this->assertDatabaseHas('topik', [
            'id'   => 'rpl',
            'nama' => 'RPL & Cloud',
        ]);

        $this->actingAs($admin)
            ->delete(route('topik.destroy', $topik))
            ->assertRedirect(route('topik.index'));

        $this->assertDatabaseMissing('topik', ['id' => 'rpl']);
    }
}
