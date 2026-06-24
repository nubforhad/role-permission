<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\User;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'member_code',
        'email',
        'father_name',
        'mother_name',
        'spouse_name',
        'mobile_number',
        'opening_date',
        'present_address',
        'permanent_address',
        'share_amount',
        'referred_by',
        'nid_number',
        'birth_certificate_no',
        'blood_group',
        'gender',
        'religion',
        'dob',
        'monthly_income',
        'profession',
        'admission_fee',
        'passbook_fee',
        'photo',
        'signature',
        'document_file',
        'status',
    ];

    protected $casts = [
        'opening_date'   => 'date',
        'dob'            => 'date',
        'share_amount'   => 'decimal:2',
        'monthly_income' => 'decimal:2',
        'admission_fee'  => 'decimal:2',
        'passbook_fee'   => 'decimal:2',
    ];

    /**
     * Member belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Member belongs to Branch
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function nominee()
    {
        return $this->hasOne(Nominee::class);
    }
}