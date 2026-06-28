<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'installment_type_id',
        'loan_category_id',
        'branch_id',
        'member_id',
        'member_code',
        'loan_amount',
        'loan_status',
        'upline_status',
        'interest',
        'total_amount',
        'total_installment',
        'paid_per_installment',
        'remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function installmentType()
    {
        return $this->belongsTo(InstallmentType::class);
    }

    public function loanCategory()
    {
        return $this->belongsTo(LoanCategory::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}