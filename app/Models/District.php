<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Thana;

class District extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'title'
    ];

     public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
}
