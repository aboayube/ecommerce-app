<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementUser extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'image', 'period', 'type', 'status', 'user_id', 'product_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
