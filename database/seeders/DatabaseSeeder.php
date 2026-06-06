<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Education;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin HoaxChecker',
            'email' => 'admin@hoaxchecker.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Verifikator
        User::factory()->create([
            'name' => 'Verifikator',
            'email' => 'verifikator@hoaxchecker.test',
            'password' => bcrypt('password'),
            'role' => 'verifikator',
        ]);

        // Edukasi contoh
        Education::insert([
            [
                'title' => 'Cara Mengenali Clickbait',
                'content' => 'Konten lengkap edukasi clickbait...',
                'category' => 'clickbait',
                'views' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '5 Langkah Verifikasi Informasi',
                'content' => 'Konten verifikasi...',
                'category' => 'verifikasi',
                'views' => 85,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bahaya Penyebaran Hoaks',
                'content' => 'Konten edukasi hoaks...',
                'category' => 'bahaya',
                'views' => 210,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}