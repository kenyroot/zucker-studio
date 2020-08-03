<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Прогноз погоды</title>
</head>
<body>
<div class="weather">
    <div class="weather__row">
        <div class="weather__day">
            <div class="weather__bottom">Нью-Йорк</div>
            <div class="weather__top">{{$weather['now']}}</div>
            <div class="weather__image"><img src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{$weather['icon']}}.svg" alt=""></div>
            <div class="weather__bottom">{{$weather['temp']}}&deg;</div>
        </div>
    </div>
</div>
</body>
</html>