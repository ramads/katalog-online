<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'status', 'supplier_id'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function getImageURL() {
        if ($this->image && $this->image != '')
        return asset('products_images/' . $this->image);
        return asset('images/default_product.png');
    }

    public function deleteImage() {
        $oldImage = $this->image;
        if (! empty($oldImage) && ($oldImage !== 'default.png')) {
            \Storage::disk('products_images')->delete($oldImage);
        }
    }

    public static function insertRules() {
        return [
            'name'                  => 'required|min:3',
            'price'                 => 'required',
            'image'                 => 'mimes:jpeg,jpg,png|max:500',
            'supplier_id'           => 'required',
        ];
    }

    public static function updateRules() {
        return Product::insertRules();
    }
}
