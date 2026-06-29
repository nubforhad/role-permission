<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstallmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'duration',
        'ins_code',
    ];

    
}
