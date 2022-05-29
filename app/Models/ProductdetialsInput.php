<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductdetialsInput extends Model
{
    use HasFactory;
    protected $fillable = ['input1', 'input1_en', 'inputt2', 'input2_en', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function input1()
    {
        if (App::getLocale() == 'ar') {
            $input1 = $this->input1;
        } else {
            $input1 = $this->input1_en;
        }
        return $input1;
    }
    public function input2()
    {
        if (App::getLocale() == 'ar') {
            $input2 = $this->input2;
        } else {
            $input2 = $this->input2_en;
        }
        return $input2;
    }
}
