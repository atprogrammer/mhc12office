<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStore extends Model
{
    use HasFactory;

    protected $fillable = [
         'user_id_add', 'book_type','name_book','book_storage','book_unit','book_detail','book_from','book_image',
        
    ];
}
