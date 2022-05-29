<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productdetails extends Model
{
    use HasFactory;
    protected $fillable = ['color', 'size', 'status', 'image', 'measuring', 'measuring_value', 'appearance', 'appearance_value', 'user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
