<?php

namespace App\Http\Controllers;

use App\Models\sauces;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaucesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sauces = sauces::all();

        return view('admin.sauces.index', compact('sauces'));
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

        $newPrice = str_replace(',', '.', $request->price);

        $sauce = new sauces();
        $sauce->name = ucfirst($request->name);
        $sauce->price = $newPrice;
        $this->checkImage($request, $sauce);
        $sauce->save();

        return redirect()->route('admin.sauces.index')->with('success', 'Saus toegevoegd');
    }

    /**
     * Display the specified resource.
     */
    public function show(sauces $sauces)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sauce = sauces::where('id', $id)->firstOrFail();

        return view('admin.sauces.edit', compact('sauce'));
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

        $newPrice = str_replace(',', '.', $request->price);

        $sauce = sauces::where('id', $id)->firstOrFail();
        $sauce->name = ucfirst($request->name);
        $sauce->price = $newPrice;
        $this->checkImage($request, $sauce, 1);
        $sauce->save();

        return redirect()->route('admin.sauces.index')->with('success', 'Saus aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        sauces::destroy($id);

        return redirect()->route('admin.sauces.index')->with('success', 'Saus verwijderd');
    }

    public function checkImage(Request $request, $table, $update = 0)
    {
        if($update === 1)
        {
            if($request->file('image'))
            {
                $newName = 'sauce-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/sauce', $newName);
                $table->image = $newName;
            }
        }
        else
        {
            if($request->file('image'))
            {
                $newName = 'sauce-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/sauce', $newName);
                $table->image = $newName;
            }
            else
            {
                $table->image = 'sauce-default.png';
            }
        }
    }
}
