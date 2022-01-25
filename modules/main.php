<?php

/* $courses = $main->getCoursesList(1, 3, "DESC");
$news_list = $main->getNewsList(1, 4);

$newcources = "";
ob_start();
foreach ($courses as $course) {
    if ($course['published'] == 1 || ($course['published'] == 0 && $main->isAdmin())) {
        include (__DIR__."/../templates/course_elem.php");
    }
}
$newcources = ob_get_contents();
ob_end_clean();

$news = "";
ob_start();
foreach ($news_list as $news) {
    if ($news['published'] == 1 || ($news['published'] == 0 && $main->isAdmin())) {
        include (__DIR__."/../templates/news_elem.php");
    }
}
$news = ob_get_contents();
ob_end_clean(); */

include_once(__DIR__."/../templates/main.php")

?>