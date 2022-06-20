<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QRCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'profileimage',
        'upiid',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function get_qrcode_by_id($id)
    {
        return QRCode::find($id);
    }
}
