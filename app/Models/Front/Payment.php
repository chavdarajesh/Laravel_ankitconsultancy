<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'emi_amount',
        'emi_amount_id',
        'payment_screenshot',
        'status',
        'is_verified',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    static public function get_total_payment_by_user_id($id)
    {
        return Payment::where('user_id',$id)->get();
    }
}
