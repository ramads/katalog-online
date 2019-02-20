<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'email', 'birth_year', 'city_id'];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function getAge() {
        return date('Y') - $this->birth_year;
    }

    public static function insertRules() {
        return [
            'name'                  => 'required|min:3',
            'email'                 => 'required|unique:suppliers,email',
            'birth_year'            => 'required',
            'city_id'               => 'required',
        ];
    }

    public static function updateRules($id) {
        $rules = Supplier::insertRules();
        $rules['email'] = $rules['email'] . ',' . $id;
        return $rules;
    }
}
