<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Support\Str;
use App\Http\Requests\DishFormRequest;

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
        $data = $request->validated();
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $data['image_path'] = 'images/' . $filename;
        } else {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));

            $imageUrl = $faker->imageUrl(640, 480, ['food'], true);
            $imageContents = file_get_contents($imageUrl);

            $filename = 'images/' . time() . '_' . Str::random(8) . '.jpg';
            file_put_contents(public_path($filename), $imageContents);

            $data['image_path'] = $filename;
        }

        $data['user_id'] = auth()->id();

        $dish = Dish::create($data);

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
