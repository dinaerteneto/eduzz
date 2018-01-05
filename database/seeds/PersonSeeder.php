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
        foreach(range(1,30) as $i) {
            $faker = Faker\Factory::create();

            Person::create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_birth' => $faker->date,
                'gender' => $faker->randomElement(['M', 'F'])
            ]);

            foreach(range(1,3) as $a) {
                $contactTypeId = $faker->randomElement([1,2,3]);
                $value = $faker->phoneNumber;
                if($contactTypeId == 1) {
                    $value = $faker->email;
                }
                Contact::create([
                    'person_id' => $i,
                    'contact_type_id' => $contactTypeId,
                    'value' => $value
                ]);
            }
        }
    }
}
