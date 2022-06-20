<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nette\SmartObject;

class EMIAmount extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'status',
        'emi_amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
