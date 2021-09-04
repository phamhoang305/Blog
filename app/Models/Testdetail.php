<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
class Testdetail extends Model
{
    use Sortable;
    protected $table = 'test_details';
    public $sortable = ['id', 'test_listID','title','note','check_uniqid','created_at'];

}
