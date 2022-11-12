<?
    if($info_user['otziv'] == 1){
        require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
        $link->query ("UPDATE `user` SET `otziv`='0' WHERE user_id = $user_id");
        message($user_id,'✅ Отлично, огромное спасибо за отзыв!',$kbd);
    }
    else{
        message($user_id,'❗Я не смог найти твой отзыв');
    }