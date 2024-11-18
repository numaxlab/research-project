<?php

namespace NumaxLab\ResearchProject\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResearchLine extends Model
{
    use HasFactory;
    use HasTranslations;
    use CrudTrait;


    protected $fillable = [
        'name',
        'short_description',
        'long_description',
        'slug',
        'is_public'
    ];


    protected $translatable = ['name', 'short_description', 'long_description', 'slug'];

    public function people(): BelongsToMany
    {
        return $this->BelongsToMany(
            Person::class,
            'research_line_person'

        );
    }

    public function projects(): BelongsToMany
    {
        return $this->BelongsToMany(
            ResearchProject::class,
            'research_line_research_project',
            'research_line_id',
            'project_id'

        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
            ]
        ];
    }

}
