<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transactions;
use DateTime;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Transactions::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456',
        ]);

        Transactions::factory()->create([
            'description' => 'teste Descrição',
            'amount' => '29.99',
            'amount' => date("d-m-Y H:i:s"),
        ]);
    }
}
