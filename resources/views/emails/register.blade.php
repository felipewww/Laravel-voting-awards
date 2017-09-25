<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
    <img src="http://startupawards2017.azurewebsites.net/site/media/images/startup_awards.png" alt="startup awards logo">
    <br>
    <br>
    Olá {{ $user }},
    <br>
    Obrigado por se registrar no Startup Awards {{ env('APP_YEAR') }}.
    <br>
    <br>
    Use o link abaixo para votar:
    <br>

    <a href="{{ env('APP_URL') }}/login/form/{{ $link }}"> {{ env('APP_URL') }}/login/form/{{ $link }} </a>
</body>