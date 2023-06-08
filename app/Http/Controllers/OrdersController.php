<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DateInterval;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return View("orderings.index",[
            'orderings'=>Orders::all(),
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
            'ordering_time' => 'required|date|after:today',
            'MenuItem_id' => 'required|gt:0',
        ]);
        $ordering = new Ordering;
        $Ordering->ordering_time = $validated['ordering_time'];
        $ordering->MenuItem()->associate(MenuItem::find($validated['MenuItem_id']));
        $ordering->server()->associate($request->user());
        $ordering->save();

        return redirect(route('orderings.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //$this->authorize('update',$ordering);
        return view('orderings.edit',[
            'ordering'=>$ordering,
            'MenuItem'=>MenuItem::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders):View
    {
        $this->authorize('update', $ordering);
        $ordering_time = date_create($ordering->ordering_time);
        $seconds = $ordering_time->format('s');
        if($seconds > 0){
            $ordering_time->sub(new DateInterval("PT".$seconds."S"));
            $ordering->ordering_time = $ordering_time->format('c');
        }
        return view('orderings.edit',[
            'ordering'=>$ordering,
            'MenuItem'=>SMenuItem::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders): RedirectResponse
    {
        $this->authorize('update',$ordering);
        $validated = $request->validate([
            'ordering_time' => 'required|date|after:today',
            'MenuItem_id' => 'required|gt:0',
        ]);
        $ordering->update($validated);

        return redirect(route('orderings.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }

    public function MenuItem(): BelongsTo
    {
        //
    }
}
