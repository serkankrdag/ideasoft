<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    
    public function productsList() {
        $products = Products::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($products);
    }
    
}
