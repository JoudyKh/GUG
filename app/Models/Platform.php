<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function requests(){
        return $this->belongsToMany(ProjectRequest::class, 'project_request_platform', 'platform_id', 'project_request_id');
    }
}
