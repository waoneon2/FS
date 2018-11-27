<?php
global $fielding_calendar_page;

$page_title = single_cat_title( '' , false ) . " Events";
$fielding_calendar_page = $page_title;

include 'archive-event.php';