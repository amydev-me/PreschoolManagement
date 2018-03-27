<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:26 AM
 */

namespace Data\Repositories;


use Data\Models\User;

class UserRepository extends Repository
{

    function model()
    {
        return User::class;
    }

    public function checkUserName($username){
        return User::where('username',$username)->first();
    }

    public function removeUser($id,$role){
        $user = User::where('access_id',$id)->where('type',$role);
        if($user){
            $user->delete();
        }
    }

    public function getUserByRole($role,$pages){
        return User::where('type',$role)->paginate($pages);
    }
}