<?php

namespace App\Entities;

use App\Entities\Entity;

class Person extends Entity
{
    protected $table = 'person';

    protected $fillabre = [
        'name',
        'last_name',
        'date_birth',
        'gender'
    ];

    public function contacts() {

    }
}
