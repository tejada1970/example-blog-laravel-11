<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function getRouteKeyName() {
        return 'slug';
    }

    // relacion muchos a muchos
    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
