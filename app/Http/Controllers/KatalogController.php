<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class KatalogController extends Controller {
    public function index() {
        $products = Product::paginate(6);;
        // dd($products);
        return view('katalog', ['products' => $products]);
    }
}
