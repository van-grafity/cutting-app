<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'style',
        'description',
        'gl_id',
    ];
    
    protected $dates = ['deleted_at'];


    public function gl()
    {
        return $this->belongsTo(Gl::class, 'gl_id', 'id');
    }
}
