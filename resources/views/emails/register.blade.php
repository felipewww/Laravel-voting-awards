<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
    Olá {{ $user }},
    <br>
    Obrigado por se registrar no Startup Awards {{ env('APP_YEAR') }}.
    <br>
    <br>
    Use o link abaixo para votar:

    <a href="{{ env('APP_URL') }}/login/form/{{ $link }}"> {{ env('APP_URL') }} </a>
</body>