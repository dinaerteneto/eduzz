<?php

use Illuminate\Database\Seeder;
use App\Entities\Person;
use App\Entities\Contact;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('contact')->truncate();
        DB::table('person')->delete();

        foreach(range(1,30) as $i) {
            $faker = Faker\Factory::create();

            $person = Person::create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_birth' => $faker->date,
                'gender' => $faker->randomElement(['M', 'F'])
            ]);

            foreach(range(1,3) as $a) {
                $contactTypeId = $a;
                $value = $faker->phoneNumber;
                if($contactTypeId == 1) {
                    $value = $faker->email;
                }

                Contact::create([
                    'person_id' => $person->id,
                    'contact_type_id' => $contactTypeId,
                    'value' => $value
                ]);
            }
        }
    }
}
