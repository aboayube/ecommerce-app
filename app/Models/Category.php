<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_en', 'status', 'user_id', 'parent_id', 'image'];
    public function name()
    {
        if (App::getLocale() == 'ar') {
            $name = $this->name;
        } else {
            $name = $this->name_en;
        }
        return $name;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
