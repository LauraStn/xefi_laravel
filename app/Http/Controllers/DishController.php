<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishFormRequest;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view dishes')->only(['index', 'show']);
        $this->middleware('permission:create dishes')->only(['create', 'store']);
        $this->middleware('permission:update dishes')->only(['edit', 'update']);
        $this->middleware('permission:delete dishes')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', [
            'dishes' => Dish::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes.form', [
            'dish' => new Dish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishFormRequest $request)
    {
        $dish = Dish::create(array_merge(
            $request->validated(),
            ['user_id' => auth()->id()]
        )); 

        return to_route('home')->with('success', 'Le plat a bien été créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('dishes.index', [
            'dish' => $dish
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
         return view('dishes.form', [
            'dish' => $dish
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishFormRequest $request, Dish $dish)
    {
        $dish->update($request->validated());
        return to_route('home')->with('success', 'Le plat a bien été édité');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return to_route('home')->with('success', 'Le plat a bien été supprimé');
    }
}
