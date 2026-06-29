<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'installment_type_id',
        'name',
        'code',
        'interest_rate',
        'deposit_type',
        'duration',
        'duration_type',
        'minimum_amount',
        'maximum_amount',
        'status',
        'description',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_amount' => 'decimal:2',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Created By
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Installment Type
    public function installmentType()
    {
        return $this->belongsTo(InstallmentType::class);
    }

    // One Category Has Many Deposits
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}