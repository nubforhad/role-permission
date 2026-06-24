<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'nominee_name',
        'father_name',
        'mother_name',
        'mobile_number',
        'relation',
        'nid_number',
        'address',
        'photo',
        'signature',
        'document_file',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
