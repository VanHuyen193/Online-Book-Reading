<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'title', 'author', 'genre', 'description', 'cover_image', 'status'
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
