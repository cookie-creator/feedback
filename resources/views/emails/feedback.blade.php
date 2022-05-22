<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Feedback</title>
</head>
<body>
    <h2>Feedback from client {{ $feedback->name }}</h2>

    <p>Client E-mail address: {{ $feedback->email }}</p>

    <h4>{{ $feedback->subject }}</h4>

    <p>{{ $feedback->feedback }}</p>

    @if(isset($urlToFile))
        <p>Client's <a target="_blank" href="{{ $urlToFile }}">Attached file</a></p>
    @endif
</body>
</html>
