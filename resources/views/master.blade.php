<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="@yield('seo_tags', 'tag1, tag2')">
    <meta name="description" content="@yield('seo_description', '')">
    <meta name="author" content="Alex Renoki">

    <meta name="theme-color" content="@yield('appbar_hex_color', '#000aee')">
    <meta name="msapplication-navbutton-color" content="@yield('appbar_hex_color', '#000aee')">
    <meta name="msapplication-TileColor" content="@yield('appbar_hex_color', '#000aee')">
    <meta name="apple-mobile-web-app-status-bar-style" content="@yield('appbar_hex_color', '@yield('appbar_hex_color', '#000aee')')">
    <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">

    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('seo_title', '')" />
    <meta property="og:description"content="@yield('seo_description', '')" />
    <meta property="og:image" content="@yield('seo_image', '/images/renoki-as-open-source-renoki.png')" />

    <meta name="twitter:card" content="summary"></meta>
    <meta name="twitter:creator" content="@twitter"></meta>

    <meta property="fb:app_id" content="">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/images/favicons/manifest.json">

    <css file="" />

    @yield('css')
    @yield('prejs')

    <title>@yield('title', 'Laravel')</title>
  </head>
  <body>
    @yield('content')

    <js file="" />
    @yield('postjs')
  </body>
</html>