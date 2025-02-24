<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid App</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @livewireStyles
</head>

<body>

    @livewire('ramzan-clock')

    
    <script src="{{ asset('js/time.js') }}"></script>
    @livewireScripts

</body>
</html>
