<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Tags extends Model
{
    use Sluggable;
    protected $table = 'tags';
    public function sluggable(): array
    {
        return [
            'tag_slug' => [
                'source' => ['tag']
            ]
        ];
    }
}
