<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory, Encryptable;

       protected $fillable = [
        'title',
        'recipe',
        'user_id',
        'image_path',
    ];

    protected array $encryptable = ['recipe'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class);
    }

}
