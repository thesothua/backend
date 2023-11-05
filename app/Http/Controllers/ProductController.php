<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string',
            'product_cat' => 'required|integer',
            'product_sub_cat' => 'required|integer',
            'product_brand' => 'integer',
            'product_title' => 'required|string',
            'product_price' => 'required|string',
            'product_desc' => 'required|string',
            'featured_image' => 'required',
            'qty' => 'required|integer',
            // 'product_keywords' => '',
            // 'product_views' => '',
            'product_status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $insertProudct = Product::insert($validator->validated());

        if ($insertProudct) {
            return response()->json(['code' => 200, 'message' => 'Product added successfully']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Product added successfully']);
        }
    }

    /**
     * Display the specified resource.
     */

    public function show($id = null)
    {
        $id = $_GET['id'];
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
