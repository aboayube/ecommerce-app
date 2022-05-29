<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appevaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'evaluation', 'user_id',
        'note'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
