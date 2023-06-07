<?php
namespace App\Http\Controllers;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return View("MenuItem.Index",[
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
        $MenuItem = MenuItem::create($validated);
        $MenuItem->save();

        return redirect(route('MenuItem.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $MenuItem)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $MenuItem): View
    {
        return view('MenuItem.Edit',[
            'MenuItem' => $MenuItem,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $MenuItem):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'basePrice_cents' => 'integer|gte:0',
            'duration_minutes' => 'integer|gte:0',
            'description' => 'nullable|string',
        ]);

        $MenuItem->update($validated);

        return redirect(route('MenuItem.index'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $MenuItem)
    {
        //
    }
}