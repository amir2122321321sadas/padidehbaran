<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="{{\App\Models\Setting::first() ? Storage::url(\App\Models\Setting::first()->favicon) : ''}}" />
<link rel="stylesheet" href="{{asset("assets/css/dependencies/swiper-bundle.min.css")}}" />
<link rel="stylesheet" href="{{asset("assets/css/dependencies/plyr.min.css")}}" />
<link rel="stylesheet" href="{{asset("assets/css/fonts.css")}}" />
<link rel="stylesheet" href="{{asset("assets/css/app.css")}}" />
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>{{ $title ?? 'Page Title' }}</title>

