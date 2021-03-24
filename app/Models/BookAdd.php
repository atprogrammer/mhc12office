<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAdd extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 'book_date','book_volume','book_file',
       
   ];
}
