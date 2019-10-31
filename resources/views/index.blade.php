<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSTF TOKEN Header -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Place Search</title>
</head>
<body>
    <div id="app">
        <!-- Place Search Component -->
        <place-component></place-component>
    </div>

    <!-- Import Vue.js -->
    <script src="/js/app.js"></script>
</body>
</html>