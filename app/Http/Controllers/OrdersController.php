<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\RedirectResponse;

use DateInterval;



class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return View("orders.index",[
            'orders'=>Order::where('done', true)
                ->where('delivered', false)
                ->get(),
            // 'orders'=>Order::where('delivered', false)->get(),
            'MenuItems'=>MenuItem::all(),
        ]);
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
        $validated = $request->validate([
            'order_time' => 'required|date|after:today',
            'MenuItem_id' => 'required|gt:0',
        ]);
        $order = new Order;

        $order->order_time = $validated['order_time'];
        $order->MenuItem()->associate(MenuItem::find($validated['MenuItem_id']));
        $order->server()->associate($request->user());
        $order->save();

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //$this->authorize('update',$order);
        return view('orders.edit',[
            'order'=>$order,
            'MenuItems'=>MenuItem::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order):View
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {

        $validated = $request->validate([
            'order_time' => 'required|date|after:today',
            'MenuItem_id' => 'required|gt:0',
        ]);
        $order->update($validated);

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

    }

    public function MenuItem(): BelongsTo
    {
        //
    }
    public function delivered(Order $order)
    {


        $order->delivered = true;
        $order->save();

        return redirect(route('orders.index'));

    }

     }




