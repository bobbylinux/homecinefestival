<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class,20)->create();
        factory(App\Models\Ciclo::class,5)->create()->each(function($ciclo) {
            factory(App\Models\Titolo::class,10)->make()->each(function($titolo) use($ciclo) {
               $ciclo->titoli()->save($titolo);
            });
        });
    }
}


