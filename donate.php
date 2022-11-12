<?php
    require_once('/home/user2/sites/lillego.tk/clicker/public.php');
    $bot_id = '192902863'; // ID вашей группы
    $secret_key = 'xpaVHovBKr'; // Секретный ключ для обработки платежей

    $arr_sign = array(
    $_REQUEST['amount'], // Сумма платежа
    $_REQUEST['pay_id'], // ID платежа в вашей системе
    $bot_id,
    $secret_key
    );

    $sign = hash('sha256', implode(":", $arr_sign));
    
    if ($sign != $_REQUEST['sign']) {
        die('Неверная контрольная сумма!');
    }
    $amount = $_REQUEST['amount'];
    $user_id = $_REQUEST['pay_id'];
    $link = new mysqli('localhost', 'root', 'OXc2TMifn35T3XCF', 'clicker');
    $token = 'bf2e917f64aba4120d60128a57d8403982fe9e0abf2751b2245c9b5576fd75cbed7e5c3ecd7bae4dece1b';
    $query = "SELECT `user_id` FROM `user` WHERE user_id = '".$user_id."'";
    $sql = mysqli_query ($link,$query);  
    if (mysqli_num_rows($sql) > 0){
        $info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));
        if($amount == 500){
            $link->query("UPDATE `user` SET `stats`='3' WHERE user_id = '".$user_id."'");
            require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
            message($user_id,'👑 Ты купил привилегию ADMIN!<br>💰 Спасибо за донат ❤',$kbd);

        }
        elseif($amount == 35){
            require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
            $link->query("UPDATE `user` SET `stats`='1' WHERE user_id = '".$user_id."'");
            message($user_id,'⭐ Ты купил привилегию VIP!<br>💰 Спасибо за донат ❤',$kbd);
        }
        elseif($amount == 30){
            require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
            $farm = $info_user['avto_click'] + 1;
            $nextWeek = time() + 3600;
            $link->query("UPDATE `user` SET `avto_click_time`='$nextWeek',`avto_click`='".$farm."' WHERE user_id = '".$user_id."'");
            message($user_id,'🖥 Ты купил майнинг ферму!<br>💰 Спасибо за донат ❤',$kbd);
        }
        elseif($amount == 20){
            require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
            $link->query("UPDATE `user` SET `stats`='2' WHERE user_id = '".$user_id."'");
            message($user_id,'🔥 Ты купил привилегию PREMIUM!<br>💰 Спасибо за донат ❤',$kbd);
        }
        $query = "SELECT `ref_user` FROM `ref_user` WHERE ref_user = '".$user_id."'";
        $sql = mysqli_query ($link,$query);  
        if (mysqli_num_rows($sql) > 0){
            $info_ref = mysqli_fetch_assoc($link->query("SELECT * FROM `ref_user` WHERE ref_user = '".$user_id."'"));
            $info_ref_user = mysqli_fetch_assoc($link->query("SELECT don_money FROM `user` WHERE ref_user = '".$info_ref['user_id']."'"));
            $symma = intval(($amount*5) / 100);
            $dons = $info_ref_user['don_money'] + $symma;
            $link->query("UPDATE `user` SET `don_money`='".$dons."' WHERE user_id = '".$info_ref['user_id']."'");
            message($user_id,'💰 Ты получил с реферала: '.$symma.' руб');
        }
        $dons = $info_user['don_money'] + $amount;
        $link->query("UPDATE `user` SET `don_money`='".$dons."',`lll`='0',`donate`='1' WHERE user_id = '".$user_id."'");
    }
    $request_params = array( 
    'chat_id' => '-1001305813663', 
    'text' => "<b>☝ Clicker: | 💶 ID: {$user_id} пополнил свой баланс на сумму: {$amount}</b>", 
    'parse_mode' => 'html',
    'reply_markup' => $replyMarkup, 
    ); 
    $date = http_build_query($request_params); 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
    curl_setopt($ch, CURLOPT_URL,'https://api.telegram.org/bot1907646672:AAG0jJL4gEzB4RpQOi1eqTUOU85FqaiNEpw/sendMessage?');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    mysqli_close($link);
    echo '{"status": "ok"}';
?>