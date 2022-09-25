<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{URL::asset('/')}}{{setPublic()}}dashboard/images/favicon.png">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('/')}}{{setPublic()}}dashboard/assets/css/dashlite.css?ver=2.9.1">
    <link id="skin-default" rel="stylesheet" href="{{URL::asset('/')}}{{setPublic()}}dashboard/assets/css/theme.css?ver=2.9.1">
    @yield('stylesheet')
    <style>
        .img-display-block{
            display: block;
            margin-left:auto;
            margin-right:auto;
            width: 150px;
            height: 150px;
        }
    </style>
</head>
