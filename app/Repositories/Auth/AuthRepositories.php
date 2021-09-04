<?php
namespace App\Repositories\Auth;

use App\Repositories\EloquentRepository;
use Auth;
use App\User;
use App\Models\Users;
class AuthRepositories extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
    public function _checkLogin($us,$pass)
    {
        $fieldType = filter_var($us, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $data = ['email'=>$us,'password'=>$pass];
        if($fieldType=='username'){
                    $data = ['username'=>$us,'password'=>$pass];
        }
        if (Auth::attempt($data)) {
            return true;
        }else{
            return false;
        }
    }
    public function _register($data)
    {
        $users = new Users();
        $users->full_name = $data->full_name;
        $users->email = $data->email;
        if(!empty($data->password)){
            $users->password = bcrypt($data->password);
        }else{
            $users->password = bcrypt("123456");
        }

        $result = $users->save();
        $this->updateUserName($data);
        if($result) return true;
        return false;
    }
    public function updateUserName($data)
    {
        $users =  Users::where('email','=',$data->email)->first();
        $users->username = uniqid();
        $users = $users->save();
    }
}
