<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'Laravel' }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="icon" type="image/png" sizes="32x32" href="{{ basset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ basset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ basset('favicon.ico') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
