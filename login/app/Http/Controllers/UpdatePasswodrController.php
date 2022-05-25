<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UpdatePasswodrController extends Controller
{
    //
    public function mail($SendData ,$toUser){
        $data = [
            'toUser' => $toUser,
            'text' => '天道酬勤，地道酬善，人道酬诚，商道酬信，业道酬精',
            'VerifyNum' => $SendData
        ];
        Mail::send(new MailSend($data));
    }
    public function sendVerifyNum($toUser): int
    {
        $seed = time();
        srand($seed);
        $VerifyNum = rand(100000, 999999);  // 六位验证码
        $this->mail($VerifyNum, $toUser);
        return $VerifyNum;
    }
    public function receive(Request $request){
        $request->validate([
            'username' => 'email',
            'password1' => 'required|min:6',
            'password2' => 'required|min:6'
        ]);
        if($request->password1 == $request->password2){
            $VerifyNum = $this->sendVerifyNum($request->username);

            return view('verify_updatePassword', [
                'VerifyNum' => $VerifyNum.' '.$request->username.' '.$request->password1
            ]);
        }else{
            echo '您两次输入的密码不一致,请重新输入！';
        }
    }
    public function checkVerifyNum_updatePassword(Request $request){
        $res = explode(' ', $request->RandVerifyNum);
        if($res[0] == $request->VerifyNum){
            echo '验证通过'.'<br>';
            echo '要修改的邮箱:'.$res[1].'<br>';
            echo '请确认您的新密码:'.$res[2].'<br>';
            // 在这里调用md5算法进行加密
            $md5_password = md5($res[2]);
            $this->mysql($res[1], $md5_password);
        }else{
            echo '您输入的验证码有误，请重新输入！'.'<br>';
        }
    }
    public function mysql($mail, $password){
        // 在这里调用md5算法
        DB::table('table_users')->where('email', $mail)
            ->update([
               'password' => $password
            ]);
    }
}
