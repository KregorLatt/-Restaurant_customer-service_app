<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use  Illuminate\View\View;


class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return View("OrderStatus.index",[
            'orderings'=>Orders::all()
                        ->whereNull('OrderStatus_id')
                        ->where('ordering_time','>=',now())
                        ->sortBy('ordering_time'),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderStatus $orderStatus)
    {
        $ordering->client()->associate($request->user());
        $ordering->update();

        return redirect(route('OrderStatus.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $orderStatus)
    {
        //
    }
}
