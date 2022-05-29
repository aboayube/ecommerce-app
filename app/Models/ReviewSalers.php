<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewSalers extends Model
{
    use HasFactory;
    protected $fillable = ['note', 'evaluation', 'product_id', 'user_id', 'salers_id'];
 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salers()
    {
        return $this->belongsTo(User::class, 'salers_id');
    }
}
