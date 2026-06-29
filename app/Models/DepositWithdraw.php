<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositWithdraw extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'branch_id',
        'deposit_id',

        'withdraw_no',

        'withdraw_date',
        'withdraw_amount',

        'payment_method',

        'status',
        'remark',
    ];

    protected $casts = [

        'withdraw_date' => 'date',
        'withdraw_amount' => 'decimal:2',
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