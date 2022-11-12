<?
    require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
    $time = $info_user['time_vivod'] + (60*60*4);
    $link->query ("UPDATE `user` SET `time_vivod`='".$time."' WHERE user_id = '".$user_id."'");
    message($user_id,'❗Ты получил штраф в размере 4 часов до следующего вывода!',$kbd);