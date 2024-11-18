<?php

namespace NumaxLab\ResearchProject\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchProject extends Model
{
    use HasFactory;
    use HasTranslations;
    use CrudTrait;


    protected $table = 'research_projects';

    protected $fillable = [
        'title',
        'introduction',
        'long_description',
        'init_date',
        'final_date',
        'financiers',
        'amount',
        'documents',
        'videos',
        'images',
        'slug',
        'is_public',
        'main_image'
    ];

    protected $translatable = [
        'title',
        'introduction',
        'long_description',
        'slug',
        'images',
        'videos',
        'slug'
    ];

    protected $casts = ['financiers' => 'array', 'documents' => 'array', 'videos' => 'array', 'images' => 'array'];

    public function people(): belongsToMany
    {
        return $this->belongsToMany(
            Person::class,
            'research_project_person',
            'project_id'

        )->withPivot('rol');
    }


    public function research_lines(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchLine::class,
            'research_line_research_project',
            'project_id'

        );
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class, 'project_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
            ]
        ];
    }

}
