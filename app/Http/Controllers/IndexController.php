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
    $data = array(
      'iccids' => array(
        0 => '89860619140058594308',
        1 => '89860619140059011757',
        2 => '89860619140059011765',
        3 => '89860619140059011781',
        4 => '89860619140059011849',
      )
    );
    $data = http_build_query($data);
    $opts = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencodedrn' . 'Content-Length: ' . strlen($data) . '\r\n', 'content' => $data));
    $context = stream_context_create($opts);
    $html = file_get_contents('http://npt.henancrsm.com/cards_info', false, $context);
    dd($html);
    // return view('index');



    // $post_data = array(
    //   'iccid' => '89860619140058594308',
    //   '_token' => csrf_token(),
    // );
    // $data = $this->send_post('http://npt.henancrsm.com/card_info', $post_data);
    // dd($data);

    // $data = array(
    //   'verification' => md5(env('APP_ID') . env('SECRET_KEY')),
    // );
    // $data = http_build_query($data);
    // $opts = array('http' => array('method' => 'GET', 'header' => 'Content-type: application/x-www-form-urlencodedrn' . 'Content-Length: ' . strlen($data) . '\r\n', 'content' => $data));
    // $context = stream_context_create($opts);
    // $html = file_get_contents('http://npt.henancrsm.com/card_info', false, $context);
    // echo $html;



    // $http = new \GuzzleHttp\Client();
    // $response = $http->request('POST', 'http://npt.henancrsm.com/card_info', [
    //   'form_params' => [
    //     'iccids' => array(
    //       0 => '89860619140058594308',
    //       1 => '89860619140059011757',
    //       2 => '89860619140059011765',
    //       3 => '89860619140059011781',
    //       4 => '89860619140059011849',
    //     ),
    //   ]
    //   // 'form_params' => [
    //   //   'iccid' => '89860619140058594308',
    //   // ]
    // ]);
    // // $response = $client->request('GET', 'http://npt.henancrsm.com/card_info/89860619140058594308');
    // if ((int) $response->getStatusCode() === 200) {
    //   $res = json_decode($response->getBody());
    //   dd($res);
    // } else {
    //   dd('faild');
    // }
  }


  // 获取卡详情 单卡
  public function get_card_info()
  {
    $iccid = '89860619140058594308';
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_info', [
      'form_params' => [
        'iccid' => $iccid,
      ]
    ]);
    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
    } else {
      dd('faild');
    }
  }


  // 获取卡详情 多卡
  public function get_cards_info()
  {
    $iccids = array(
      0 => '89860619140058594308',
      1 => '89860619140059011757',
      2 => '89860619140059011765',
      3 => '89860619140059011781',
      4 => '89860619140059011849',
    );
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_info', [
      'form_params' => [
        'iccids' => $iccids,
        'verification' => md5(env('APP_ID') . env('SECRET_KEY')),
      ]
    ]);
    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
      if ($res->message == '成功' && $res->status == '0000') {
        dd($res->data);
      }
    } else {
      dd('faild');
    }
  }

  // 停卡 单卡
  public function stop_card()
  {
    $iccid = '89860619140059011823';
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_stop', [
      'form_params' => [
        'iccid' => $iccid,
      ]
    ]);

    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
    } else {
      dd('faild');
    }
  }

  // 停卡 多卡
  public function stop_cards()
  {
    $iccids = array(
      0 => '89860619140059011823',
      1 => '89860619190033586473',
    );
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_stop', [
      'form_params' => [
        'iccids' => $iccids,
      ]
    ]);
    // $response = $client->request('GET', 'http://npt.henancrsm.com/card_info/89860619140058594308');
    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
    } else {
      dd('faild');
    }
  }

  public function open_card()
  {
    $iccid = '89860619140059011823';
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_begin', [
      'form_params' => [
        'iccid' => $iccid,
      ]
    ]);

    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
    } else {
      dd('faild');
    }
  }

  public function open_cards()
  {
    $iccids = array(
      0 => '89860619140059011823',
      1 => '89860619190033586473',
    );
    $http = new \GuzzleHttp\Client();
    $response = $http->request('POST', 'http://npt.henancrsm.com/card_begin', [
      'form_params' => [
        'iccids' => $iccids,
      ]
    ]);

    if ((int) $response->getStatusCode() === 200) {
      $res = json_decode($response->getBody());
      dd($res);
    } else {
      dd('faild');
    }
  }
}
