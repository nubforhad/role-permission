<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanUp extends Model
{
    protected $fillable = [
        'branch_id',
        'member_id',
        'loan_up_category_id',
        'loan_amount',
        'interest_rate',
        'interest_type',
        'duration',
        'duration_type',
        'installment_type',
        'total_interest',
        'total_payable',
        'emi_amount',
        'start_date',
        'approval_date',
        'disbursement_date',
        'status',
        'note',
    ];

    public function category()
    {
        return $this->belongsTo(LoanUpCategory::class, 'loan_up_category_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}