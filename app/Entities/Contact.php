<?php

namespace App\Entities;

use App\Entities\Entity;

class Contact extends Entity
{
    protected $table = 'contact';

    protected $fillabre = [
        'person_id',
        'contact_type_id',
        'value',
        'description',
    ];

}
