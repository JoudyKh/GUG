<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDomain extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function requests(){
        return $this->hasMany(ProjectRequest::class, 'project_domain_id');
    }
}
