<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * @param $SendData
     * @param $toUser
     * @return void
     */
    public function mail($SendData ,$toUser){
        $data = [
            'toUser' => $toUser,
            'text' => '天道酬勤，地道酬善，人道酬诚，商道酬信，业道酬精',
            'VerifyNum' => $SendData
        ];
        Mail::send(new MailSend($data));
    }

    public function index(){
        return view('LoginFrame.index');
    }
    public function receive(Request $request){
        //对用户名和密码做验证
        $request->validate([
            'username' => 'email',
            'password' => 'required|min:6'
        ]);
        // 在这里判断是注册或者是登陆
        if($request->table == 'login'){
            // 进入验证密码环节
            $res = DB::table('table_users')->select('password')
                ->where('email', $request->username)->get();
            $res = json_decode($res, true);
            var_dump($res[0]['password']);// 数据库查找到的密码

            // 在这里调用md5

            $md5_password = md5($request->password);

            if($md5_password == $res[0]['password']){
                echo '匹配成功';
                return view('login');
            }else{
                echo '匹配失败';
            }

            // sql查询密码
        }elseif ($request->table == 'register'){
            // echo '请求path是register';
            $toUser = $request->username; // 获取用户输入的邮箱
            $VerifyNum = $this->sendVerifyNum($toUser);
            // return到输入验证码环节
            return view('verify', [
                'VerifyNum' => $VerifyNum.' '.$request->username.' '.$request->password
            ]);// 不知道还有什么方法，现在只能把随机生成的一起传递到视图中，不然就会消失
        }
    }
    /**
     * @param $toUser
     * @return int
     */
    public function sendVerifyNum($toUser): int
    {
        $seed = time();
        srand($seed);
        $VerifyNum = rand(100000, 999999);  // 六位验证码
        $this->mail($VerifyNum, $toUser);
        return $VerifyNum;
    }

    /**
     * @param Request $request
     * @return void
     * 用于检查用户输入的验证码和及其生成的验证码是否一致
     */

    public function checkVerifyNum(Request $request): void
    {
        $res = explode(' ', $request->RandVerifyNum);
        if($res[0] == $request->VerifyNum){
            echo '验证通过'.'<br>';
            echo '请确认您的邮箱:'.$res[1].'<br>';
            echo '请确认您的密码:'.$res[2].'<br>';
            // 在这里调用md5算法进行加密
            $md5_password = md5($res[2]);
            $this->mysql($res[1], $md5_password);
        }else{
            echo '您输入的验证码有误，请重新输入！'.'<br>';
        }
    }

    public function mysql($mail, $password){
        DB::table('table_users')->insert([
            'email' => $mail,
            'password' => $password
        ]);
    }
}


