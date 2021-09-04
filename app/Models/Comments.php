<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Comments extends Model
{
    use Sortable;
    protected $table = 'comments';

}

