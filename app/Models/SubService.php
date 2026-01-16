<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubService extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'title',
        'logo',
        'description',
    ];
    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }
}
