<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCollection extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'branch_id',
        'deposit_id',

        'collection_no',

        'collection_date',

        'collection_amount',

        'payment_method',

        'status',

        'remark',
    ];

    protected $casts = [

        'collection_date' => 'date',

        'collection_amount' => 'decimal:2',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

}