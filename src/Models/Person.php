<?php

namespace NumaxLab\ResearchProject\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    use HasFactory;
    use HasTranslations;
    use CrudTrait;


    public const ROL_COLLABORATOR = 'collaborator';
    public const ROL_INVESTIGATOR = 'investigator';
    public const ROL_PRINCIPAL_INVESTIGATOR = 'principal_investigator';

    protected $table = 'people';


    protected $fillable = [
        'name',
        'function',
        'photo_path',
        'email',
        'web_profiles',
        'biography',
        'cv_file',
        'slug',
        'is_public',
        'category_id',
        'phone_number'
    ];

    protected $translatable = [
        'function',
        'biography',
        'slug',
    ];

    protected $casts = ['web_profiles' => 'array'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchProject::class,
            'research_project_person',
            'person_id',
            'project_id'

        )->withPivot('rol');
    }

    public function research_lines(): BelongsToMany
    {
        return $this->belongsToMany(
            ResearchLine::class,
            'research_line_person',

        );
    }

    public function publications(): belongsToMany
    {
        return $this->belongsToMany(Publication::class, 'publication_person');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
            ]
        ];
    }

    public function getWebProfilesAsArrayAttribute()
    {
        if ($this->web_profiles) {
            return json_decode($this->web_profiles, true);
        }

        return [];
    }


}
