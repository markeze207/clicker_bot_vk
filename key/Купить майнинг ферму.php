<?php
    $link->query("INSERT INTO `DON`() VALUES ()");	
    $id = $link->insert_id;
    $link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
    $id = $user_id.'_'.$id.'_Farm';
    $bot_id = 192902863;
    $vk_id = $user_id;
    $amount = '30.00';
    $secret_key = 'xpaVHovBKr';
    $arr_sign = array(
        $bot_id,
        $vk_id,
        $amount,
        $secret_key
    );
    
    $sign = hash('sha256', implode(':', $arr_sign));
    $url_pay = 'https://vlito.ru/paying/?bot_id='.$bot_id.'&amount='.$amount.'&p='.$param.'&vk_id='.$vk_id.'&sign='.$sign;

    $request_params = array( 
        'url' => $url_pay, 
        'access_token' => $token, 
        'private' => '0',
        'v' => '5.111',
    ); 
    $get_params = http_build_query($request_params); 
    $info_vixod = file_get_contents('https://api.vk.com/method/utils.getShortLink?'. $get_params); 
    $json = json_decode($info_vixod,true);
    $ssilka = $json['response']['short_url'];
    $kbd = [
        'one_time' => false,
        'inline' => false,
        'buttons' => [
                [getBtnlink("Пополнить", COLOR_positive, $ssilka )],
                [getBtn("Вернуться назад", COLOR_DEFAULT,'Улучшения')],
        ]
    ];	
    message($user_id,'🖥 Ты собираешься купить "Майнинг ферму"<br><br>💶 Сумма к оплате: 30 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
    $query = "UPDATE `user` SET `buyinfo`='Farm' WHERE user_id = '".$user_id."'";
    $sql = mysqli_query ($link,$query);