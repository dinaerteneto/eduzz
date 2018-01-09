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
        if(!DB::table('contact_type')->where('id', 1)->first()) {

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
}
