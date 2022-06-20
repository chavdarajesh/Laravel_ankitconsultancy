<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetails extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'status',
        'bank_name',
        'branch_name',
        'branch_code',
        'ifsc_code',
        'bank_aaccount_no',
        'bank_aaccount_holder_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
