<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_section_id',
        'user_id',
        'member_id',
        'employee_id',
        'member_code',
        'installment_amount',
        'paid_amount',
        'penalty_charge',
        'installment_date',
        'paid_date',
        'expire_date',
        'status',
        'remark',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Loan (parent)
    public function loan()
    {
        return $this->belongsTo(LoanSection::class, 'loan_section_id');
    }

    // Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Created by / employee
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // User (optional system user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function loanSection()
{
    return $this->belongsTo(LoanSection::class, 'loan_section_id');
}

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (Optional but useful)
    |--------------------------------------------------------------------------
    */

    // Remaining amount for this installment
    public function getDueAmountAttribute()
    {
        return max(0, ($this->installment_amount + $this->penalty_charge) - $this->paid_amount);
    }

    // Check if fully paid
    public function getIsPaidAttribute()
    {
        return $this->paid_amount >= ($this->installment_amount + $this->penalty_charge);
    }
}