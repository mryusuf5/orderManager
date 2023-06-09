<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ProductCategories;
use App\Models\sauces;
use App\Models\Tables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Tables::all();
        return view('admin.tables.index', compact(
            'tables'
        ));
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

        $table = new Tables();
        $table->name = $request->name;
        $table->save();

        $table->qr_code = route('userTable', $table->id);
        $table->url = route('admin.tables.edit', $table->id);

        $table->save();

        return redirect()->route('admin.tables.index')->with('success', 'Tafel opgeslagen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $table = Tables::where('id', $id)->firstOrFail();
        $categories = ProductCategories::with('products')->get();
        $sauces = sauces::all();

        $orders = Orders::join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.*', 'products.name', 'products.price', 'products.description', 'products.image')
            ->where('table_id', $id)
            ->where('ready', '0')
            ->where('paid', '0')
            ->get();

        return view('user.tables.show', compact(
            'table',
            'categories',
            'sauces',
            'orders'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $table = Tables::where('id', $id)->firstOrFail();
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $table = Tables::where('id', $id)->firstOrFail();
        $table->name = $request->name;
        $table->save();

        return redirect()->route('admin.tables.index')->with('success', 'Tafel aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tables::destroy($id);

        return redirect()->route('admin.tables.index')->with('success', 'Tafel verwijderd');
    }
}
