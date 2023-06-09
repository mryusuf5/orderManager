<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Controllers\Controller;
use App\Models\sauces;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
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
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $product = new Products();

        $newPrice = str_replace(',', '.', $request->price);

        $product->name = ucfirst($request->name);
        $product->description = ucfirst($request->description);
        $product->price = $newPrice;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $this->checkImage($request, $product);
        $product->save();


        return redirect()
            ->route('admin.productcategories.edit', $request->category_id)
            ->with('success', 'Product opgeslagen');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Products::where('id', $id)->firstOrFail();

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $newPrice = str_replace(',', '.', $request->price);

        $product = Products::where('id', $id)->firstOrFail();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $newPrice;
        $product->stock = $request->stock;
        $this->checkImage($request, $product, 1);
        $product->save();

        return redirect()
            ->route('admin.productcategories.edit', $product->category_id)
            ->with('success', 'Product aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Products::destroy($id);

        return redirect()->back()->with('success', 'Product deleted');
    }

    public function checkImage(Request $request, $table, $update = 0)
    {
        if($update === 1)
        {
            if($request->file('image'))
            {
                $newName = 'product-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/product', $newName);
                $table->image = $newName;
            }
        }
        else
        {
            if($request->file('image'))
            {
                $newName = 'product-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/product', $newName);
                $table->image = $newName;
            }
            else
            {
                $table->image = 'product-default.png';
            }
        }
    }

    public function userProductApi(Request $request)
    {
        $product = Products::where('id', $request->id)->firstOrFail();
        $sauces = sauces::all();

        return response()->json(compact(
            'product',
            'sauces')
        );
    }
}
