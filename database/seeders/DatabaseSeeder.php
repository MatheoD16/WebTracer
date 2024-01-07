<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(SceneSeeder::class);
        $this->call(CommentaireSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(FavorisSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
    }
}
