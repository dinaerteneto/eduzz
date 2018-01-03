<?php

use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_type')->insert(
            [
                ['name' => 'E-Mail'],
                ['name' => 'Telefone Celular'],
                ['name' => 'Telefone Comercial'],
                ['name' => 'Telefone Residencial'],
                ['name' => 'Telefone Recados'],
            ]
        );

    }
}
