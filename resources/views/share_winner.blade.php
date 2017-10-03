<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta property="fb:app_id"        content="{{ env("FB_APP_ID") }}" />
    <meta property="og:url"           content="{{ env('APP_URL') }}/vencedores/{{$cat_id}}/winner" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Startup Awards {{env("APP_YEAR")}}" />
    <meta property="og:description"   content="Parabéns! {{ $name }} foi o vencedor do Startup Awards {{env("APP_YEAR")}} na categoria {{ $cat_name }}." />
    <meta property="og:image"         content="{{ env('APP_URL') }}/site/media/images/{{$image_name}}" />
</head>
<body>
</body>