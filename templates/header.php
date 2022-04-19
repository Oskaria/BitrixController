<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicon/site.webmanifest">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/assets/css/hint.min.css" >
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="/assets/js/scripts.js"></script>
        <title>Bitrix Controller</title>
    </head>
    <body>
    <div class="wrapper">

        <div class="popup-wrap"></div>
        <div class="popup login">
            <div class="title">Авторизация</div>
            <form class="form">
                <div class="inputgroup">
                    <label>Email</label>
                    <input type="text" name="email">
                    <div class="errortext"></div>
                </div>
                <div class="inputgroup">
                    <label>Пароль</label>
                    <input type="password" name="password">
                    <div class="errortext"></div>
                </div>
                <div class="inputgroup">
                    <input type="submit" value="Войти" class="button">
                </div>
                <p><a href="#" class="a_remind">Забыли пароль?</a></p>
            </form>
        </div>
        <div class="popup remind">
            <div class="title">Восстановление пароля</div>
            <form class="form">
                <input type="hidden" name="remind" value="remind">
                <div class="inputgroup">
                    <label>Email</label>
                    <input type="text" name="email">
                    <div class="errortext"></div>
                </div>
                <div class="inputgroup">
                    <input type="submit" value="Отправить" class="button">
                </div>
            </form>
        </div>

        <div class="head">
            <div class="center1600">
                <a href="/" class="logo">
                    <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 76.4 58.1" style="enable-background:new 0 0 76.4 58.1;" xml:space="preserve"><style type="text/css">.st01{fill:#F95157;}.st1{fill:#282828;}.st2{fill:none;stroke:#F95157;stroke-miterlimit:10;}.st3{fill:none;stroke:#F95157;stroke-width:0.5;stroke-miterlimit:10;}</style><g><g><path class="st01" d="M68.5,0L68.5,0L68.5,0z"/><path class="st01" d="M68.5,0L54.6,13.6c0.2,0.2,0.3,0.3,0.5,0.5c0,0,0,0.1,0.1,0.1c0,0,0,0,0.1,0.1c3.5,3.9,5.5,9.1,5.5,14.7 c0,12.3-9.9,22.2-22.2,22.2c-6.1,0-11.6-2.5-15.7-6.5l-0.1,0.1c5.7,5.2,13.3,8.4,21.6,8.4c6.5,0,12.5-1.9,17.5-5.2 c8.7-5.7,14.5-15.6,14.5-26.8C76.5,13,73.5,5.6,68.5,0z"/></g></g><circle class="st1" cx="38.5" cy="29.2" r="11.7"/><path class="st2" d="M60.7,28.9c0,12.3-9.9,22.2-22.2,22.2c-0.8,0-1.5,0-2.3-0.1c-0.3,0-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.1-0.9-0.1l0,0 c-0.1,0-0.3,0-0.4-0.1l0,0c-0.1,0-0.2,0-0.3-0.1h-0.1c-0.4-0.1-0.8-0.2-1.1-0.3c-0.1,0-0.2-0.1-0.3-0.1s-0.2,0-0.3-0.1 c-0.1,0-0.2-0.1-0.2-0.1l0,0c-0.2-0.1-0.5-0.1-0.7-0.2c0,0,0,0-0.1,0c-0.3-0.1-0.6-0.2-0.8-0.3c-0.4-0.2-0.8-0.3-1.1-0.5 c-0.1,0-0.2-0.1-0.2-0.1c-0.2-0.1-0.5-0.2-0.7-0.4l0,0c0,0-0.1,0-0.1-0.1c-0.3-0.2-0.5-0.3-0.8-0.5l0,0c-0.1,0-0.1-0.1-0.2-0.1 c-0.1-0.1-0.3-0.2-0.5-0.3c-0.2-0.2-0.5-0.3-0.7-0.5c-0.1-0.1-0.2-0.2-0.3-0.2c-0.3-0.2-0.6-0.5-0.9-0.7c-0.5-0.4-0.9-0.8-1.3-1.2 c-0.1,0-0.1-0.1-0.2-0.2l0,0L23,44.6c-0.5-0.5-0.9-1-1.3-1.5c-0.2-0.3-0.5-0.5-0.7-0.8c0,0,0-0.1-0.1-0.1c-0.2-0.3-0.4-0.5-0.6-0.8 c-0.2-0.3-0.4-0.6-0.6-0.9c-0.2-0.3-0.3-0.6-0.5-0.9s-0.3-0.6-0.4-0.8c0,0,0,0,0-0.1c-0.2-0.3-0.3-0.7-0.5-1 c-0.1-0.2-0.2-0.4-0.2-0.6c0-0.1-0.1-0.2-0.1-0.2c-0.1-0.2-0.1-0.3-0.2-0.5c-0.1-0.2-0.2-0.5-0.2-0.7c-0.1-0.4-0.2-0.7-0.3-1.1 c-0.1-0.3-0.1-0.6-0.2-0.9c-0.1-0.3-0.1-0.6-0.2-0.9c0-0.2-0.1-0.4-0.1-0.6c-0.1-0.6-0.2-1.3-0.2-1.9c0-0.1,0-0.2,0-0.3 c0-0.3,0-0.6,0-0.9c0-12.3,9.9-22.2,22.2-22.2c4.5,0,8.6,1.3,12.1,3.6c1.3,0.8,2.5,1.8,3.6,2.9c0.1,0.1,0.2,0.2,0.4,0.4l0.1,0.1 c0,0,0.1,0.1,0.1,0.2c0.1,0.1,0.2,0.2,0.2,0.3c0,0,0,0.1,0.1,0.1c0,0,0,0,0.1,0.1C58.6,18.1,60.7,23.3,60.7,28.9z"/><path class="st3" d="M60.7,28.9c0,12.3-9.9,22.2-22.2,22.2c-0.8,0-1.5,0-2.3-0.1c-0.3,0-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.1-0.9-0.1l0,0 c-0.1,0-0.3,0-0.4-0.1l0,0c-0.1,0-0.2,0-0.3-0.1h-0.1c-0.4-0.1-0.8-0.2-1.1-0.3c-0.1,0-0.2-0.1-0.3-0.1s-0.2,0-0.3-0.1 c-0.1,0-0.2-0.1-0.2-0.1l0,0c-0.2-0.1-0.5-0.1-0.7-0.2c0,0,0,0-0.1,0c-0.3-0.1-0.6-0.2-0.8-0.3c-0.4-0.2-0.8-0.3-1.1-0.5 c-0.1,0-0.2-0.1-0.2-0.1c-0.2-0.1-0.5-0.2-0.7-0.4l0,0c0,0-0.1,0-0.1-0.1c-0.3-0.2-0.5-0.3-0.8-0.5l0,0c-0.1,0-0.1-0.1-0.2-0.1 c-0.1-0.1-0.3-0.2-0.5-0.3c-0.2-0.2-0.5-0.3-0.7-0.5c-0.1-0.1-0.2-0.2-0.3-0.2c-0.3-0.2-0.6-0.5-0.9-0.7c-0.5-0.4-0.9-0.8-1.3-1.2 c-0.1,0-0.1-0.1-0.2-0.2l0,0L23,44.6c-0.5-0.5-0.9-1-1.3-1.5c-0.2-0.3-0.5-0.5-0.7-0.8c0,0,0-0.1-0.1-0.1c-0.2-0.3-0.4-0.5-0.6-0.8 c-0.2-0.3-0.4-0.6-0.6-0.9c-0.2-0.3-0.3-0.6-0.5-0.9s-0.3-0.6-0.4-0.8c0,0,0,0,0-0.1c-0.2-0.3-0.3-0.7-0.5-1 c-0.1-0.2-0.2-0.4-0.2-0.6c0-0.1-0.1-0.2-0.1-0.2c-0.1-0.2-0.1-0.3-0.2-0.5c-0.1-0.2-0.2-0.5-0.2-0.7c-0.1-0.4-0.2-0.7-0.3-1.1 c-0.1-0.3-0.1-0.6-0.2-0.9c-0.1-0.3-0.1-0.6-0.2-0.9c0-0.2-0.1-0.4-0.1-0.6c-0.1-0.6-0.2-1.3-0.2-1.9c0-0.1,0-0.2,0-0.3 c0-0.3,0-0.6,0-0.9c0-12.3,9.9-22.2,22.2-22.2c4.5,0,8.6,1.3,12.1,3.6c1.6,1.1,3.1,2.4,4.4,3.8c0,0,0,0.1,0.1,0.1c0,0,0,0,0.1,0.1 C58.6,18.1,60.7,23.3,60.7,28.9z"/><path class="st01" d="M50.6,10.3C47.1,8,43,6.7,38.5,6.7c-12.3,0-22.2,10-22.2,22.2c0,0.3,0,0.6,0,0.9c0,0.1,0,0.2,0,0.3 c0,0.6,0.1,1.3,0.2,1.9c0,0.2,0.1,0.4,0.1,0.6c0,0.3,0.1,0.6,0.2,0.9s0.1,0.6,0.2,0.9c0.1,0.4,0.2,0.7,0.3,1.1 c0.1,0.2,0.2,0.5,0.2,0.7c0.1,0.2,0.1,0.4,0.2,0.5c0,0.1,0.1,0.2,0.1,0.2c0.1,0.2,0.1,0.4,0.2,0.6c0.2,0.4,0.3,0.7,0.5,1 c0,0,0,0,0,0.1c0.1,0.3,0.3,0.6,0.4,0.8c0.2,0.3,0.3,0.6,0.5,0.9s0.4,0.6,0.6,0.9c0.2,0.3,0.4,0.6,0.6,0.8c0,0,0,0.1,0.1,0.1 c0.2,0.3,0.4,0.6,0.7,0.8c0.4,0.5,0.9,1,1.3,1.5L8.6,58.1C3.3,52.4,0,44.7,0,36.2C0,25,5.8,15.1,14.5,9.4c5-3.3,11.1-5.2,17.5-5.2 C39,4.3,45.4,6.5,50.6,10.3z"/><path class="st2" d="M54.2,13.2c0.1,0.1,0.2,0.2,0.3,0.4l0.1,0.1c0.1,0.1,0.1,0.1,0.1,0.2c0.1,0.1,0.2,0.2,0.2,0.3c0,0,0,0,0.1,0.1 c0,0,0,0,0.1,0.1c3.5,3.9,5.5,9.1,5.5,14.7c0,12.3-9.9,22.2-22.2,22.2c-0.8,0-1.5,0-2.3-0.1c-0.3,0-0.6-0.1-0.9-0.1 c-0.3,0-0.6-0.1-0.9-0.1l0,0c-0.1,0-0.3,0-0.4-0.1c-0.1,0-0.2,0-0.2-0.1h-0.1h-0.1c-0.4-0.1-0.8-0.2-1.1-0.3c-0.1,0-0.2-0.1-0.3-0.1 s-0.2,0-0.3-0.1c-0.1,0-0.2-0.1-0.2-0.1s0,0-0.1,0c-0.2-0.1-0.5-0.1-0.7-0.2l0,0c0,0,0,0-0.1,0c-0.3-0.1-0.6-0.2-0.8-0.3 c-0.4-0.2-0.8-0.3-1.1-0.5c-0.1,0-0.2-0.1-0.2-0.1c-0.2-0.1-0.5-0.2-0.7-0.4l0,0l0,0c0,0-0.1,0-0.1-0.1c-0.3-0.2-0.5-0.3-0.8-0.4 c0,0,0,0-0.1,0s-0.1-0.1-0.2-0.1c-0.1-0.1-0.3-0.2-0.4-0.3c-0.2-0.2-0.5-0.3-0.7-0.5c-0.1-0.1-0.2-0.1-0.3-0.2 c-0.3-0.2-0.6-0.5-0.9-0.7c-0.5-0.4-0.9-0.8-1.3-1.2C23,45.1,23,45.1,22.9,45l-0.1-0.1c-0.5-0.5-0.9-1-1.3-1.5 c-0.2-0.3-0.5-0.6-0.7-0.8"/></svg>
                    Bitrix Controller
                </a>
                <div class="menu">
                    <a href="/sites/">Сайты</a>
                    <?if (!$main->isAuth()) {?>
                        <a href="/login/" class="button log">Войти</a>
                    <?} else {?>
                        <a href="/users/">Пользователи</a>
                        <a href="/logout/">Выйти</a>
                    <?}?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="content">