<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'content'];

    /**
     * Get the chapters associated with the book.
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'book_id', 'id');
    }
    
    public function savedByUsers()
    {
        return $this->hasMany(SavedBook::class);
    }
}
