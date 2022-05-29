<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'period', 'price', 'status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
}
}
