<?php

namespace App\Entities;

use Carbon\Carbon;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Entity
{

    use SoftDeletes;

    const GENDER_MALE = 'Masculino';
    const GENDER_FEMALE = 'Feminino';

    protected $table = 'person';

    protected $fillable = [
        'name',
        'last_name',
        'date_birth',
        'gender'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $attributesLabel = [
        'name' => 'Nome',
        'last_name' => 'Sobrenome',
        'gender' => 'Sexo'
    ];

    protected $rules = [
        'name' => 'required|string',
        'last_name' => 'required|string',
    	'gender' => 'string',
    ];

    public function contacts() {
        return $this->hasMany('App\Entities\Contact', 'person_id', 'id');
    }
}
