<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use App\Models\sauces;
use App\Models\supplements;
use App\Models\Tables;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    public function allOrdersApi()
    {
        $orders = Orders::join('tables', 'tables.id', '=', 'orders.table_id')
            ->select('orders.*', 'tables.name')
            ->where('ready', '1')
            ->where('paid', '0')
            ->where(function ($query) {
                $query->whereRaw('orders.id = (
            SELECT MAX(o.id)
            FROM orders o
            WHERE o.table_id = orders.table_id
            AND o.ready = 1
            AND o.paid = 0
        )');
            })
            ->get();

        return response()->json(['orders' => $orders]);
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
        $order = new Orders();
        $order->product_id = $request->product_id;
        $order->remark = $request->remark;
        $order->table_id = $request->table;

        if($request->sauce)
        {
            $sauces = "";
            $saucesCount = count($request->sauce);
            $i = 0;
            foreach($request->sauce as $index => $sauce)
            {
                if(++$i === $saucesCount)
                {
                    $sauces .= $sauce;
                }
                else
                {
                    $sauces .= $sauce . ',';
                }
            }
            $order->sauces = $sauces;
        }

        if($request->supplement)
        {
            $supplements = "";
            $supplementsCount = count($request->supplement);
            $i = 0;
            foreach($request->supplement as $index => $supplement)
            {
                if(++$i === $supplementsCount)
                {
                    $supplements .= $supplement;
                }
                else
                {
                    $supplements .= $supplement . ',';
                }
            }

            $order->supplements = $supplements;
        }

        $order->save();

        return redirect()->route('userTable', $request->table)->with('success', 'Toegevoegd aan bestelling');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $orders = Orders::join('tables', 'tables.id', '=', 'orders.table_id')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.*', 'tables.name as table_name', 'products.name', 'products.price', 'products.description',
                'products.image')
            ->where('table_id', $request->id)
            ->where('ready', '1')
            ->where('paid', '0')
            ->get();

        $sauces = sauces::all();
        $supplements = supplements::all();

        $totalPrice = 0;
        foreach($orders as $order)
        {
            $totalPrice += $order->price;
        }


        return view('admin.orders.edit', compact(
            'orders',
        'totalPrice',
        'sauces',
        'supplements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Orders::where('table_id', $id)
            ->where('ready', '0')
            ->where('paid', '0')
            ->update(['ready' => '1']);


        return redirect()->route('userTable', $id)->with('success', 'Bestelling geplaatst');
    }

    public function orderPaid(Request $request, $id)
    {
        $order = Orders::where('table_id', $id)
            ->where('ready', '1')
            ->where('paid', '0')
            ->update(['paid' => '1']);

        return redirect()->route('admin.orders.index')->with('success', 'Bestelling betaald');
    }

    /**
     * Remove the specified resource from storage.F
     */
    public function destroy($id)
    {
        Orders::destroy($id);

        return redirect()->back()->with('success', 'Bestelling verwijderd');
    }
}
