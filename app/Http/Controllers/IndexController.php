<?php

namespace App\Http\Controllers;

use App\Manager;
use App\models\Permission;
use App\models\Role;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  /*
    创建用户组
    GET
    */
  public function create_group_user()
  {
    $admin = new Role;
    $admin->name = 'Administartor';
    $admin->save();

    $owner = new Role;
    $owner->name = 'admin';
    $owner->save();
  }



  // 创建权限
  public function create_quanxian()
  {
    $createPost = new Permission();
    $createPost->name = 'create-post';
    $createPost->display_name = 'Create Posts';
    $createPost->description = 'create new blog posts';
    $createPost->save();

    $editUser = new Permission();
    $editUser->name = 'edit-user';
    $editUser->display_name = 'Edit Users';
    $editUser->description = 'edit existing users';
    $editUser->save();

    $user = Manager::where('username', 'gsy')->first();
    // $user->attachPermission($createPost);
    $user->perms()->sync(array($createPost->id));

    // $admin->attachPermissions(array($createPost, $editUser));
    //等价于 $admin->perms()->sync(array($createPost->id, $editUser->id));
  }

  // 给用户组添加权限
  public function add_group_user()
  {
    // 用户
    $user = Manager::where('username', '=', 'gsy')->first();
    // 角色组
    $group_user = Role::where('name', 'admin')->first();
    // dd($group_user);
    // role attach alias
    $user->attachRole($group_user); // parameter can be an Role object, array, or id
    // dd(1);
  }

  public function index()
  {
    $admin = new Role;
    $admin->name = 'Administartor';
    $admin->save();

    $owner = new Role;
    $owner->name = 'admin';
    $owner->save();
    $user = Manager::where('username', '=', 'gsy')->first();

    //调用EntrustUserTrait提供的attachRole方法
    $user->attachRole($owner); // 参数可以是Role对象，数组或id


    $createPost = new Permission();
    $createPost->name = 'create-post';
    $createPost->display_name = 'Create Posts';
    $createPost->description = 'create new blog posts';
    $createPost->save();

    $editUser = new Permission();
    $editUser->name = 'edit-user';
    $editUser->display_name = 'Edit Users';
    $editUser->description = 'edit existing users';
    $editUser->save();

    $owner->attachPermission($createPost);
  }

  public function check()
  {
    $user = Manager::where('username', 'gsy')->first();
    $res = $user->hasRole('Administartor');
    dd($user->can('create-post'));
  }

  public function html()
  {
    return view('index');
  }
}
