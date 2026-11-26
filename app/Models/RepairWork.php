<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RepairWork extends Model
{
    protected $table = 'repair_works';

    protected $primaryKey = 'work_id';

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(
            Blog::class,
            'blog_repair_work',
            'work_id',
            'blog_id'
        );
    }
}
