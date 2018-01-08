<?php

namespace App\Repositories;

use App\Entities\Person;
use App\Entities\Contact;


class PersonRepository
{
    const TYPE_EMAIL = 1;
    const TYPE_CELLPHONE = 2;
    const TYPE_COMERCIAL_PHONE = 3;
    const TYPE_HOME_PHONE = 4;
    const TYPE_SCRAP_PHONE = 5;

    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * return a person based on id (primary key)
     * @param integer $id
     * @return Person
     */
    public function read(int $id) {
        return Person::with(['contacts' => function ($model) {
            return $model->with('contactType');
        }])->find($id);
    }

    /**
     * return data of the person family
     * @return array
     */
    public function get() {
        return $this->person->with(['contacts' => function ($model) {
            return $model->with('contactType');
        }])->get();
    }

    /**
     * add contact for person
     * @param String $value
     * @param int $type
     * @param String $description
     * @return boolean
     */
    public function addContact(array $data = [])
    {
        foreach ($data as $value) {
            $contact = Contact::find($value['id']);
            if (!$contact) {
                $contact = new Contact();
            }
            $dataContact['person_id'] = $this->person->id;
            $dataContact['contact_type_id'] = $value['type'];
            unset($value['type']);
            $dataCombine = array_merge($dataContact, $value);
            $contact->fill($dataCombine);
            $contact->save();
        }
        return true;
    }

    public function save() {
        return $this->person->save();
    }

}
