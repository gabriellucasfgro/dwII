<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::insert('INSERT INTO portes(descricao) VALUES(?)',
    		array('Pequeno'));

        DB::insert('INSERT INTO portes(descricao) VALUES(?)',
            array('Médio'));

        DB::insert('INSERT INTO portes(descricao) VALUES(?)',
            array('Grande'));
    }
}
