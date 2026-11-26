<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    protected $table = 'blog';

    protected $primaryKey = 'blog_id';

    public const CREATED_AT = 'dt_created';

    public const UPDATED_AT = 'dt_updated';

    protected $fillable = [
        'title',
        'description',
        'text',
        'category_id',
        'user_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(BlogTranslation::class, 'blog_id', 'blog_id');
    }

    public function getTranslatedAttribute(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        if ($this->relationLoaded('translations')) {
            $translation = $this->translations->firstWhere('locale', $locale);
        } else {
            $translation = $this->translations()->where('locale', $locale)->first();
        }

        if ($translation !== null && filled($translation->{$field})) {
            return $translation->{$field};
        }

        return $this->{$field};
    }
    public function repairWorks(): BelongsToMany
    {
        return $this->belongsToMany(
            RepairWork::class,
            'blog_repair_work',
            'blog_id',
            'work_id'
        );
    }
}
