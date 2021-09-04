<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Categorys extends Model
{
    use Sluggable;
    protected $table = 'categorys';
    public function sluggable(): array
    {
        return [
            'cate_slug' => [
                'source' => ['cate_name']
            ]
        ];
    }
}
