<?php
    $link = new mysqli('localhost', 'root', 'd', 'clicker');
    $info_money = mysqli_fetch_assoc($link->query("SELECT money FROM `log` WHERE ID = '1'"));
    $request_params = array( 
        'chat_id' => '-1001305813663', 
        'text' => "<b>☝ Clicker: | ЕХАЙ БЛЯ, {$info_money['money']} рублей</b>", 
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
    $link->query("UPDATE `log` SET `money`='0' WHERE user_id = '".$row['user_id']."'");
    mysqli_close($link);