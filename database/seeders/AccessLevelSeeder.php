<?php

namespace Database\Seeders;

use App\Models\AccessLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessLevel::insert([
            [
                'name' => 'Owner',
                'code' => 'owner',
                'level' => 300,
            ],
            [
                'name' => 'Editor',
                'code' => 'editor',
                'level' => 200,
            ],
            [
                'name' => 'Viewer',
                'code' => 'viewer',
                'level' => 100,
            ],
        ]);
    }
}
