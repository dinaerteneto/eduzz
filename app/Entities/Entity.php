<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Entity extends Model
{

    public $data = [];
    private $errors;

    /**
     * validate attributes of model
     * @param $data
     * @return bool
     */
    public function validate($data) {
        $v = Validator::make($data, $this->rules, [], $this->attributesLabel);
        if($v->fails()) {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }

    /**
     * return the errors of model attributes
     * @return mixed
     */
    public function errors() {
        return $this->errors;
    }

}
