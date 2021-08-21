<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Roles extends Model
{
    use Sortable;
    protected $table = 'roles';
    public $sortable = ['id', 'role_name','role_des','created_at'];
}
