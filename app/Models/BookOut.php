<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_id', 'book_id', 'volume_book',
        
    ];
}
