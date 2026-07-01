<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    protected $table = 'loan_installments';

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

    /**
     * Loan relation
     */
    public function loan()
    {
        return $this->belongsTo(LoanUp::class, 'loan_up_id');
    }
}