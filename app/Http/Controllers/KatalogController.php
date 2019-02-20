<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class KatalogController extends Controller {
    public function index() {
        $products = Product::where('status', 1)->paginate(6);;
        return view('katalog', ['products' => $products]);
    }
}
