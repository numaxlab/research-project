<?php

namespace NumaxLab\ResearchProject\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publication extends Model
{
    use HasFactory;
    use HasTranslations;
    use CrudTrait;


    public const TYPE_FILE = 'file';
    public const TYPE_URL = 'url';

    protected $fillable = [
        'title',
        'description',
        'year',
        'pdf_file',
        'project_id',
        'slug',
        'is_public',
        'publication_type',
        'url'
    ];


    protected $translatable = ['description', 'slug'];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'publication_person');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class);
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
