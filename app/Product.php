<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'status', 'supplier_id'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public static function insertRules() {
        return [
            'name'                  => 'required|min:3',
            'price'                 => 'required',
            'image'                 => 'mimes:jpeg,jpg,png|max:500',
            'status'                => 'required',
            'supplier_id'           => 'required',
        ];
    }
}
