<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comany Management System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/app.css"/>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body id="app">
    <App></App>
</body>
<script src="{{ mix('/js/app.js') }}"></script>
</html>
