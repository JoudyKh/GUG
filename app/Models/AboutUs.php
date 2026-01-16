<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'title',
        'image',
        'description',
        'background_color',
    ];
    public function offices(){
        return $this->hasMany(Office::class, 'about_id');
    }
}
