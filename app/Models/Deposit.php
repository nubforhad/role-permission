<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'branch_id',
        'member_id',
        'deposit_category_id',

        'deposit_no',
        'member_code',

        'deposit_amount',
        'interest_rate',
        'interest_amount',
        'total_amount',

        'paid_amount',
        'due_amount',

        'start_date',
        'maturity_date',

        'status',
        'remark',
    ];

    protected $casts = [

        'deposit_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',

        'start_date' => 'date',
        'maturity_date' => 'date',
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

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function category()
    {
        return $this->belongsTo(DepositCategory::class,'deposit_category_id');
    }

    public function collections()
    {
        return $this->hasMany(DepositCollection::class);
    }

    public function withdraws()
    {
        return $this->hasMany(DepositWithdraw::class);
    }
}