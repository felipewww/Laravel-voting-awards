<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta property="fb:app_id"        content="{{ \App\Http\Controllers\Controller::$FB_APP_ID }}" />
    <meta property="og:url"           content="{{ env('APP_URL') }}/{{$catid}}/{{$name}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Startup Awards {{env("APP_YEAR")}}" />
    <meta property="og:description"   content="Indiquei {{ $name }} para a Startup Awards {{env("APP_YEAR")}} na categoria {{ $cat_name }}, indique você também!" />
    <meta property="og:image"         content="{{ env('APP_URL') }}/site/media/images/aceleradora.png" />
</head>
<body>
</body>