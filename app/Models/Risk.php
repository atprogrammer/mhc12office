<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'accident_date', 'accident_time', 'place','in_person','name_in','risk_type','risk_detail','other_detail','file_path','correction','impact_perform','impact_property','suggestion','user_id',
        
    ];
}
