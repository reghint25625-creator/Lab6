<?php

namespace App\Queries;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;

class BlogFilter
{
    /**
     * Дозволені поля для сортування (білий список).
     */
    private const SORTABLE = [
        'title'        => 'blog.title',
        'categoryName' => 'category.category_name',
        'created'      => 'blog.dt_created',
        'worksCount'   => 'repair_works_count',
    ];

    public function apply(array $input): Builder
    {
        $query = Blog::query()
            ->with(['category', 'author', 'translations', 'repairWorks'])
            ->withCount('repairWorks')
            ->leftJoin('category', 'blog.category_id', '=', 'category.category_id')
            ->select('blog.*');

        $query->when(
            $input['title'] ?? null,
            fn (Builder $q, string $value) => $q->where('blog.title', 'like', "%{$value}%")
        );

        $query->when(
            $input['categoryName'] ?? null,
            fn (Builder $q, string $value) => $q->where('category.category_name', 'like', "%{$value}%")
        );

        $query->when(
            $input['category_id'] ?? null,
            fn (Builder $q, $value) => $q->where('blog.category_id', $value)
        );

        $query->when(
            $input['repair_work_id'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'repairWorks',
                fn (Builder $related) => $related->where('repair_works.work_id', $value)
            )
        );

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc = str_starts_with($sort ?? '', '-');
        $field = $desc ? substr($sort, 1) : $sort;

        if (! isset(self::SORTABLE[$field])) {
            return $query
                ->orderByDesc('blog.dt_created')
                ->orderByDesc('blog.blog_id');
        }

        return $query
            ->orderBy(self::SORTABLE[$field], $desc ? 'desc' : 'asc')
            ->orderByDesc('blog.blog_id');
    }
}
