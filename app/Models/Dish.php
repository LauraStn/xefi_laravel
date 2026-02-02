<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

       protected $fillable = [
        'title',
        'recipe',
        'user_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class);
    }

}
