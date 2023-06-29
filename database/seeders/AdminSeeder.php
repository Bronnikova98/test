<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var User $user
         */


        $user = User::firstOrCreate([
            'name' => 'Test',
            'surname' => 'Admin',
            'email' => 'testadmin@example.com',

        ]);

        $user->setPassword(Hash::make('12345678gsegrgrg'));

        $user->assignRole('admin');

        $user->save();


    }
}
