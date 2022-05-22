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
