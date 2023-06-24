<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();

      //  return $products;
        return $this->sendResourse(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

}
