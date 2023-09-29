<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Certificate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Certificate::factory(state : [ 'type' => 0 ])
                ->has(
                    Certificate::factory(rand(0,3), [ 'type' => 1 ])
                        ->has(Certificate::factory(rand(0,3), [ 'type' => 1 ]))
                        ->has(Certificate::factory(rand(0,3), [ 'type' => 2 ]))
                    , 'certificates'
                )
                ->has(Certificate::factory(rand(0,3), [ 'type' => 2 ]), 'certificates')
                ->create();
        }

    }
}
