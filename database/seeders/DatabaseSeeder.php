<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Aspiration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan aspirasi awal tersedia jika tabel kosong
        if (DB::table('aspirations')->count() === 0) {
            DB::table('aspirations')->insert([
                [
                    'id' => 15,
                    'title' => 'wastafel',
                    'category' => 'Fasilitas',
                    'description' => 'rusak, harus diperbaiki',
                    'status' => 'Menunggu',
                    'votes' => 0,
                    'location' => 'kamar mandi',
                    'evidence_photo' => null,
                    'edit_token' => '$2y$12$vVw59VGaZLJYDkC.AZ2z3uLslbTK9zFTkQV1mzv.OrSfFjeoOAPCu',
                    'created_at' => '2026-11-09 02:11:33',
                    'updated_at' => '2026-11-09 02:11:33',
                ],
                [
                    'id' => 16,
                    'title' => 'tambah kipas angin',
                    'category' => 'Fasilitas',
                    'description' => 'kipas angin banyak yang rusak',
                    'status' => 'Menunggu',
                    'votes' => 0,
                    'location' => 'kelas',
                    'evidence_photo' => null,
                    'edit_token' => '$2y$12$sxeY6OejCxZ.g94dgd3ZAOY8WLTPzOE1vLyvlYq/jnWxaYonkb3AK',
                    'created_at' => '2026-11-09 02:12:36',
                    'updated_at' => '2026-11-09 02:12:36',
                ],
                [
                    'id' => 17,
                    'title' => 'stop kontak',
                    'category' => 'Fasilitas',
                    'description' => 'stop kontaknya putus gabisa di pake',
                    'status' => 'Menunggu',
                    'votes' => 0,
                    'location' => 'tefa',
                    'evidence_photo' => 'https://iili.io/oKtWSyl.png',
                    'edit_token' => '$2y$12$WrXv/QM5N3IsyOPHz/ICyuiTS3LwA0ilW4WNaTBiH54erwA2jJMC.',
                    'created_at' => '2026-11-09 03:43:06',
                    'updated_at' => '2026-11-09 03:43:06',
                ],
            ]);
        }
    }
}
