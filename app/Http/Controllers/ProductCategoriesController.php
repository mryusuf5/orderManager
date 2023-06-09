<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategories::all();
        return view('admin.productCategories.index', compact('categories'));
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
            'name' => 'required'
        ]);

        $category = new ProductCategories();
        $category->name = ucfirst($request->name);
        $category->description = ucfirst($request->description);
        $this->checkImage($request, $category);
        $category->save();

        return redirect()->route('admin.productcategories.index')->with('success', 'Categorie opgeslagen');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategories $productCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ProductCategories::where('id', $id)->firstOrFail();
        $products = Products::sortable()->where('category_id', $id)->get();
        return view('admin.productcategories.edit', compact(
            'category',
        'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = ProductCategories::where('id', $id)->firstOrFail();
        $category->name = $request->name;
        $this->checkImage($request, $category, 1);
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Categorie aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ProductCategories::destroy($id);
        Products::where('category_id', $id)->delete();

        return redirect()->route('admin.productcategories.index')->with('success', 'Categorie verwijderd');
    }

    public function checkImage(Request $request, $table, $update = 0)
    {
        if($update === 1)
        {
            if($request->file('image'))
            {
                $newName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/category', $newName);
                $table->image = $newName;
            }
        }
        else
        {
            if($request->file('image'))
            {
                $newName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/category', $newName);
                $table->image = $newName;
            }
            else
            {
                $table->image = 'category-default.png';
            }
        }
    }
}
