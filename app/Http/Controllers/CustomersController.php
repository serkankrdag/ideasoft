<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    
    public function customersList() {
        $customers = Customers::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($customers);
    }

}
