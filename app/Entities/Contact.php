<?php

namespace App\Entities;

use App\Entities\Entity;

class Contact extends Entity
{
    protected $table = 'contact';

    protected $fillable = [
        'person_id',
        'contact_type_id',
        'value',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $attributesLabel = [
        'person_id' => 'person_id',
        'contact_type_id' => 'contact_type_id',
        'value' => 'Valor',
        'description' => 'Descricao',
    ];

    protected $rules = [
        'person_id' => 'required|integer',
        'contact_type_id' => 'required|integer',
        'value' => 'required|string',
        'description' => 'string',
    ];

    public function contactType() {
        return $this->hasOne('App\Entities\ContactType', 'id', 'contact_type_id');
    }

}
