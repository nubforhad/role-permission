<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanUInstallment extends Model
{
 

    protected $fillable = [
        'loan_up_id',
        'installment_no',
        'amount',
        'paid_amount',
        'due_amount',
        'due_date',
        'paid_date',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(LoanUp::class, 'loan_up_id');
    }
}