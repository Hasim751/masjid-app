<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Clock</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @livewireStyles
</head>

<body>

    @livewire('clock')

    
    <script src="{{ asset('js/time.js') }}"></script>
    @livewireScripts

</body>
</html>
