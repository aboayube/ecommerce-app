<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_en',
        'status',
        'discription',
        'discription_en',
        'image',
        'email',
        'facebook',
        'twiter',
        'linked_in',
        'instagram',
        'whatsapp',
        'address',
        'address_en',
        'terms',
        'terms_en',
        'who_us',
        'who_us_en',
    ];


    public function who_us()
    {
        if (App::getLocale() == 'ar') {
            $who_us = $this->who_us;
        } else {
            $who_us = $this->who_us_en;
        }
        return $who_us;
    }
    public function terms()
    {
        if (App::getLocale() == 'ar') {
            $terms = $this->terms;
        } else {
            $terms = $this->terms_en;
        }
        return $terms;
    }
}
