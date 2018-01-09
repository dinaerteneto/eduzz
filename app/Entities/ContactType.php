<?php

namespace App\Entities;

use App\Entities\Entity;

class ContactType extends Entity
{
    protected $table = 'contact_type';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
