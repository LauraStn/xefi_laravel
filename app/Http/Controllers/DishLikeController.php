<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\RedirectResponse;

class DishLikeController extends Controller
{
    public function toggle(Dish $dish): RedirectResponse
    {
        $user = auth()->user();
        if ($dish->favoredByUsers()->where('user_id', $user->id)->exists()) {
            $dish->favoredByUsers()->detach($user->id);
        } else {
            $dish->favoredByUsers()->attach($user->id);
        }
        return back();
    }
}
