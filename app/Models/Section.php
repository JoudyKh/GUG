<?php

namespace App\Models;

use App\Constants\Constants;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory;

    protected function asJson($value): bool|string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    protected $fillable = [
        'type',
        'title',
        'description',
        'logo',
    ];
    public static $searchable = [
        'title',
    ];
    protected $hidden = [];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->hidden = $model->getHiddenAttributes();
        });

        static::saving(function ($model) {
            $model->hidden = $model->getHiddenAttributes();
        });
    }



    public function getHiddenAttributes(): array
    {
        $sectionAttributes = Constants::SECTIONS_TYPES[$this->type]['attributes'];
        $sectionAttributes[] = 'id';
        $sectionAttributes[] = 'type';
        $allAttributes = Schema::getColumnListing($this->getTable());

        return array_diff($allAttributes, $sectionAttributes);
    }


    public function images(){
        return $this->hasMany(SectionImage::class, 'section_id');
    }

    public function subServices(){
        return $this->hasMany(SubService::class, 'section_id');
    }
    public function projects(){
        return $this->hasMany(Project::class, 'section_id');
    }

}
