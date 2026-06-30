<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanUpInstallment extends Model
{
    protected $table = 'loan_up_installments';

    protected $fillable = [
        'loan_up_id',
        'installment_no',
        'amount',
        'paid_amount',
        'due_amount',
        'due_date',
        'status',
        'paid_date',
        'note',
    ];

    /**
     * Loan relation
     */
    public function loan()
    {
        return $this->belongsTo(LoanUp::class, 'loan_up_id');
    }
}