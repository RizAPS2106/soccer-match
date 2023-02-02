<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    @include('layouts.header')
</head>

<body>
    <main>
        @include('layouts.sidebar')

        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')
</body>

</html>
