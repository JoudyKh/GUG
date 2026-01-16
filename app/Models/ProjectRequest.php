<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'description',
        'project_domain_id',
        'is_electronic_payment',
        'is_shipping_service',
    ];
    public function platforms(){
        return $this->belongsToMany(Platform::class, 'project_request_platform', 'project_request_id', 'platform_id');
    }
    public function domain(){
        return $this->belongsTo(ProjectDomain::class, 'project_domain_id');
    }
}
