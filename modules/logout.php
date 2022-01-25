<?php

    unset($_SESSION['user_id']);
    echo '<div class="center1600">Вы вышли. Сейчас вы будете перенаправлены на главную страницу. Если этого не произошло - нажмите <a href="/">здесь</a>.</div>
    <script>
        setTimeout(\'location.replace("/")\',1000); 
    </script>';

?>