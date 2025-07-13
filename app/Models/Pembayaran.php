<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'date','biaya','total','id_user', 'status', 'resi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
