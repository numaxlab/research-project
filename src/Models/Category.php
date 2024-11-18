<?php

namespace NumaxLab\ResearchProject\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use CrudTrait;

    protected $fillable = ['name'];
    protected $translatable = ['name'];


    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
