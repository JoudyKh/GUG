<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone_number',
        'about_id',
    ];
    public function about(){
        return $this->belongsTo(AboutUs::class, 'about_id');
    }
}
