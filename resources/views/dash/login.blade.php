<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/login.css">

</head>

<body>
<div class="login">
    {{--<h1>Login</h1>--}}
    <img src="/site/media/images/startup_awards_white.png" style=" margin: 0 auto; display: block; margin-bottom: 20px;">
    <form method="post" action="/adm/login">
        {{ csrf_field() }}
        <input type="text" name="u" placeholder="Username" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button>
    </form>
</div>

<script src="/admin/js/login.js"></script>

</body>
</html>
