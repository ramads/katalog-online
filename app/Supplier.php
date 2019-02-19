<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'email', 'age', 'city_id'];

    public function city() {
        return $this->hasOne(City::class);
    }

    public static function insertRules() {
        return [
            'name'                  => 'required|min:3',
            'email'                 => 'required|unique:suppliers,email',
            'age'                   => 'required',
            'city_id'               => 'required',
        ];
    }
}
