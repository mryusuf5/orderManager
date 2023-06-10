<?php

namespace App\Http\Controllers;

use App\Models\supplements;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplements = supplements::all();
        return view('admin.supplements.index', compact('supplements'));
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

        $newprice = str_replace(',', '.', $request->price);

        $supplement = new supplements();
        $supplement->name = ucfirst($request->name);
        $supplement->price = $newprice;
        $supplement->save();

        return redirect()->route('admin.supplements.index')->with('success', 'Supplement opgeslagen');
    }

    /**
     * Display the specified resource.
     */
    public function show(supplements $supplements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplement = supplements::where('id', $id)->firstOrFail();

        return view('admin.supplements.edit', compact('supplement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $supplement = supplements::where('id', $id)->firstOrFail();

        $supplement->name = ucfirst($request->name);
        $supplement->price = ucfirst($request->price);
        $supplement->save();

        return redirect()->route('admin.supplements.edit', $id)->with('success', 'Supplement aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(supplements $supplements)
    {
        //
    }
}
