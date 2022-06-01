<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_en', 'image', 'email', 'product_number', 'discription', 'discription_en', 'url', 'count', 'vendor_name', 'country', 'city', 'phone', 'whatsapp', 'type', 'status', 'user_id', 'category_id'];

    public function name()
    {
        if (app()->getLocale() == 'ar') {
            $name = $this->name;
        } else {
            $name =  $this->name_en;
        }
        return $name;
    }

    public function discription()
    {
        if (app()->getLocale() == 'ar') {
            $discription = $this->discription;
        } else {
            $discription =  $this->discription_en;
        }
        return $discription;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
    public function details()
    {
        return $this->hasMany(productdetails::class);
    }



    public function rattingProdut()
    {
        return $this->hasMany(ReviewProduct::class);
    }
    public function rattingSalers()
    {
        return $this->hasMany(ReviewSalers::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function productdetails()
    {
        return $this->hasMany(productdetails::class);
    }
}
