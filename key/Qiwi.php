<?php
	$info_user = mysqli_fetch_assoc(mysqli_query($link,"SELECT buyinfo FROM `user` WHERE user_id = $user_id"));
	if($info_user['buyinfo'] == 'Admin'){

	
		$id = $user_id.'_'.$id.'_Admin';
		$bot_id = 192902863;
		$vk_id = $user_id;
		$amount = '500.00';
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
				 [getBtnlink("Оплатить", COLOR_positive, $url_pay )],
				 [getBtn("Вернуться назад", COLOR_DEFAULT,'Улучшения')],
			]
		];	
		message($user_id,'👑 Ты собираешься купить привилегию "ADMIN"<br><br>💶 Сумма к оплате: 500 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}
	elseif($info_user['buyinfo'] == 'Vip'){
		$link->query("INSERT INTO `DON`() VALUES ()");	
		$id = $link->insert_id;
		$link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
        $id = $id + time();
		$id = $user_id.'_'.$id.'_Vip';
		$bot_id = 192902863;
		$vk_id = $user_id;
		$amount = '1.00';
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
				 [getBtnlink("Пополнить", COLOR_positive, $url_pay )],
				 [getBtn("Вернуться назад", COLOR_DEFAULT,'Улучшения')],
			]
		];	
		message($user_id,'⭐ Ты собираешься купить привилегию "VIP"<br><br>💶 Сумма к оплате: 35 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}
	elseif($info_user['buyinfo'] == 'Premium'){
		$link->query("INSERT INTO `DON`() VALUES ()");	
		$id = $link->insert_id;
		$link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
        $id = $id + time();
		$id = $user_id.'_'.$id.'_Premium';
		$bot_id = 192902863;
		$vk_id = $user_id;
		$amount = '20.00';
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
				 [getBtnlink("Пополнить", COLOR_positive, $url_pay )],
				 [getBtn("Вернуться назад", COLOR_DEFAULT,'Улучшения')],
			]
		];	
		message($user_id,'🔥 Ты собираешься купить привилегию "PREMIUM"<br><br>💶 Сумма к оплате: 20 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}