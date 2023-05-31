<?php
namespace App\Http\Controllers;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return View("OrderItem.index",[
            'OrderItems'=>OrderItem::all(),
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
    
    public function store(Request $request) : RedirectResponse
    {
        //
        // https://laravel.com/docs/10.x/validation#available-validation-rules
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'basePrice_cents' => 'integer|gte:0',
            'duration_minutes' => 'integer|gte:0',
            'description' => 'nullable|string',
        ]);
        $OrderItem = OrderItem::create($validated);
        $OrderItem->save();

        return redirect(route('OrderItem.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $OrderItem)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $OrderItem)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $OrderItem)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $OrderItem)
    {
        //
    }
}