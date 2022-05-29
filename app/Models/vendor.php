<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_en', 'phone', 'country', 'city_governorate', 'street', 'gada', 'house_building', 'floor_apartment', 'special_mark', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
