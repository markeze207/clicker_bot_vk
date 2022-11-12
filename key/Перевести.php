<?
if($user_id == '334626026' || $user_id == '243674541') {
    $link->query("UPDATE `user` SET `peremen`='6' WHERE user_id = '".$user_id."'");
    message($user_id,'Укажи ID пользователя');
}
else {
    die('OK');
}