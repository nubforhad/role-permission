<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanUpCategory extends Model
{
        protected $fillable = [

            'name',

            'interest_rate',

            'interest_type',

            'duration',

            'duration_type',

            'installment_type',

            'processing_fee',

            'late_fee',

            'minimum_amount',

            'maximum_amount',

            'status',

            'description'

        ];
}
