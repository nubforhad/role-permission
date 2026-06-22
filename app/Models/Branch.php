<?php

namespace App\Models;
use App\Models\District;
use App\Models\Thana;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'district_id',
        'thana_id',
        'name',
        'address',
        'title',
    ];

    // District relation
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Thana relation
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }
}