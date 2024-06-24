<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class AddLocalTestUserSeeder extends Seeder
{
    public function run(): void
    {
        if (App::environment('local')) {
            User::create([
                'email' => 'test@test.at',
                'name' => 'mht',
                'password' => bcrypt('test'),
            ]);
        }

    }
}
