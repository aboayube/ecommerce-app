<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Onslash extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'title_en', 'description', 'user_id', 'description_en', 'image', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class);
        }

        public function title()
        {
            if (App::getLocale() == 'ar') {
                $title = $this->title;
            } else {
                $title = $this->title_en;
            }
            return $title;
        }
    public function description()
    {
        if (App::getLocale() == 'ar') {
            $description = $this->description;
        } else {
            $description = $this->description_en;
        }
        return $description;
    }
}
