<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gl extends Model
{
    use HasFactory;

    protected $fillable = [
        'gl_number',
        'season',
        'size_order',
        'buyer_id',
        'code',
    ];

    public function buyer()
    {
        return $this->belongsTo(buyer::class);
    }

    public function style()
    {
        return $this->hasMany(Style::class,'gl_id','id');
    }
}
