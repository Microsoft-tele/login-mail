<!-- #  我真诚地保证：
#  我自己独立地完成了整个程序从分析、设计到编码的所有工作。
#  如果在上述过程中，我遇到了什么困难而求教于人，那么，我将在程序实习报告中
#  详细地列举我所遇到的问题，以及别人给我的提示。
#  在此，我感谢bilibili对我的启发和帮助。下面的报告中，我还会具体地提到
#  他们在各个方法对我的帮助。
#  我的程序里中凡是引用到其他程序或文档之处，
#  例如教材、课堂笔记、网上的源代码以及其他参考书上的代码段,
#  我都已经在程序的注释里很清楚地注明了引用的出处。

#  我从未没抄袭过别人的程序，也没有盗用别人的程序，
#  不管是修改式的抄袭还是原封不动的抄袭。
#  我编写这个程序，从来没有想过要去破坏或妨碍其他计算机系统的正常运转。 
#  <李为君> 改成自己的名字 -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>updatePassword</title>
</head>
<body>
<h1>修改密码</h1>
<form action="checkPassword" method="post">
    @csrf
    <input type="text" placeholder="请输入要修改密码的邮箱" name="username"><br><br>
    @error('username')
    <div>{{$message}}</div>
    @enderror
    <input type="text" placeholder="请输入密码" name="password1"><br><br>
    @error('password1')
    <div>{{$message}}</div>
    @enderror
    <input type="text" placeholder="请再次输入密码" name="password2"><br><br>
    @error('password2')
    <div>{{$message}}</div>
    @enderror
    <button type="submit">修改</button>
</form>
</body>
</html>
