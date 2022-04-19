<?php
$sites = $main->getSitesList(1, 100);

//var_export($main->addNewSite("https", "sergiopizza.ru", "Серджио Пицца", true, "skillpoint", "Vfk3ymrb3inerb"));
//echo $main->last_error;

 /*
if (count($sites) > 0) {
    echo '<div class="center1600"><div class="sites">';
    foreach ($sites as $site) {
        ?>
        <div class="site active">
            <div class="name"><?=$site['name'];?></div>
            <div class="link"><a href="<?=$site['protocol']."://".$site['url'];?>" target="_blank"><?=$site['url'];?></a></div>
            <div class="clear"></div>
            <div class="regstatus"><strong>Статус: </strong><?=(strlen($site['auth_data']) > 1 ? "Ожидает регистрации":"Зарегистрирован");?></div>
            <div class="clear"></div>
            <div class="icon status" title="Сайт активен"><img src="/assets/images/upstate.png" /></div>
            <div class="icon watch" title="Мониторинг активен"><img src="/assets/images/watch.png" /></div>
            <div class="icon ssl" title="Сертификат активен до: 31.01.2023"><img src="/assets/images/ssl.png" /></div>
        </div>
        
        <div class="site error">
            <div class="name"><?=$site['name'];?></div>
            <div class="link"><a href="<?=$site['protocol']."://".$site['url'];?>" target="_blank"><?=$site['url'];?></a></div>
            <div class="clear"></div>
            <div class="regstatus"><strong>Статус: </strong><?=(strlen($site['auth_data']) > 1 ? "Ожидает регистрации":"Зарегистрирован");?></div>
            <div class="clear"></div>
            <div class="icon status" title="Сайт не активен!"><img src="/assets/images/warning.png" /></div>
            <div class="icon watch" title="Мониторинг активен"><img src="/assets/images/watch.png" /></div>
            <div class="icon watch" title="Сертификат активен до: 31.01.2023"><img src="/assets/images/ssl.png" /></div>
        </div>
        
        <div class="site down">
            <div class="name"><?=$site['name'];?></div>
            <div class="link"><a href="<?=$site['protocol']."://".$site['url'];?>" target="_blank"><?=$site['url'];?></a></div>
            <div class="clear"></div>
            <div class="regstatus"><strong>Статус: </strong><?=(strlen($site['auth_data']) > 1 ? "Ожидает регистрации":"Зарегистрирован");?></div>
            <div class="clear"></div>
            <div class="icon status" title="Сайт активен!"><img src="/assets/images/upstate.png" /></div>
            <div class="icon watch" title="Мониторинг активен"><img src="/assets/images/watch.png" /></div>
            <div class="icon ssl" title="Сертификат активен до: 31.01.2023"><img src="/assets/images/ssl.png" /></div>
        </div>
        <?
    }
    echo '</div></div>';

} else {
    echo "<p>Нет сайтов :(</p>";
}

*/
?>
<div class="center1600">
<h1>Сайты</h1>

<div class="sites">

    <div class="controls">
        <div class="left">
            <a href="/addnew/" class="addsite">Добавить сайт</a>
        </div>
        <div class="right">

        </div>
        <div class="clear"></div>

        <?if (count($sites) > 0) {?>

        <div class="elems">
            
            <?foreach ($sites as $site) {
                $status = $lang['ru']['site_status_'.$site['status']];
                if ($site['status'] == 2) {
                    if ($site['workstatus'] != 1) {
                        $status .= $lang['ru']['site_error_online'];
                    }
                    if ($site['certificate'] < time()) {
                        $status .= $lang['ru']['site_error_ssl'];
                    }
                    if ($site['last_code'] != 200) {
                        $status .= $lang['ru']['site_error_code'].$site['last_code'];
                    }
                }
                if ($site['updates_to'] < time()) {
                    $status = $lang['ru']['site_caution'].sprintf($lang['ru']['site_caution_licence_expired'],date("d.m.Y",$site['updates_to']));
                }

                include(__DIR__."/../templates/site.php");
            }?>

        </div>
        <?} else {?>
            <p>Нет сайтов :(</p>
        <?}?>
    </div>

</div>
</div>