<?php
namespace App\Repositories\Roles;

use App\Repositories\EloquentRepository;
use App\Models\Roles;
use Cviebrock\EloquentSluggable\Services\SlugService;
class RolesRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Roles::class;
    }
    public function getRoleList($request)
    {
        if(empty($request->q)){
            $result = Roles::sortable()->paginate(10);
            return $result;
        }else{
            $search = $request->q;
            $result = Roles::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('role_name', 'LIKE',"%{$search}%")
                ->orWhere('role_des', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getRoleByID($id)
    {
        $result = Roles::where('id','=',$id)->first();
        if($result){
            $result->permission = json_decode($result->permission);
            return $result;
        }
        return false;
    }
    public function addRole($data)
    {
        $role = new Roles();
        $role->role_name = $data->role_name;
        $role->role_des = $data->role_des;
        $role->permission = $data->permission;
        if($role->save()){
            return true;
        }else{
            return false;
        }
    }
    public function editRole($data)
    {
        $role = Roles::find($data->id);
        $role->role_name = $data->role_name;
        $role->role_des = $data->role_des;
        $role->permission = $data->permission;
        if($role->save()){
            return true;
        }else{
            return false;
        }
    }
    public function deleteRole($request)
    {
        $result =  Roles::find($request->id);
        if($result->delete()){
            return true;
        }return false;
    }
}
