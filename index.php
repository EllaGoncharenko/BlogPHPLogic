<?php
session_start();
require_once 'core/configs/main.php';
require_once 'core/library/main.php';
require_once 'core/library/validator.php';
require_once 'core/library/db.php';
require_once 'core/models/category.php';
require_once 'core/models/post.php';


//if (empty($urlSegments[0])) {
//    $cntrName = 'main';
//}else {
//    $cntrName = $urlSegments[0];
//}

//тернарный оператор
$cntrName = (empty(getUrlSegment(0)))? 'main' : getUrlSegment(0);
$actionName = (empty(getUrlSegment(1)))? 'action_index' : 'action_'.getUrlSegment(1);

if (file_exists('core/controllers/'.$cntrName.'.php')){
    require_once 'core/controllers/'.$cntrName.'.php';

    if (function_exists($actionName)) {
        $actionName ();
    } else {
        show404page();
    }
} else {
    show404page();
}
