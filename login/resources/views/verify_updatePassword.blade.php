<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
</head>
<body>
<form action="checkVerifyNum_updatePassword" method="post">
    @csrf
    <h1>验证码已发送到您的邮箱中</h1>
    <input type="text" placeholder="验证码" name="VerifyNum">
    <button type="submit" name="RandVerifyNum" value="{{$VerifyNum}}">验证</button>
</form>
</body>
</html>
