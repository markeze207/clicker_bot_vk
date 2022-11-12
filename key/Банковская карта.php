<?php
	$info_user = mysqli_fetch_assoc(mysqli_query($link,"SELECT buyinfo FROM `user` WHERE user_id = $user_id"));
	if($info_user['buyinfo'] == 'Admin'){
		$link->query("INSERT INTO `DON`() VALUES ()");	
		$id = $link->insert_id;
		$link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
        $id = $id + time();
		$id = $user_id.'_'.$id.'_Admin';
		$request_params = array( 
			'url' => 'https://oplata.qiwi.com/create?publicKey=48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPuf9Zdrc1jQTT9TGMk9vS46z7Lsh9Vs4wFvG6Mx2d1BhfLeyxt8PMgUtYeHYLaQjKXoTnzi3fxKwoupsJhkqs9EN2tC1TxibS8cMjsdL4x&amount=500.00&successUrl=vk.com&customFields[paySourcesFilter]=card&billId='.$id, 
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
		message($user_id,'👑 Ты собираешься купить привилегию "ADMIN"<br><br>💶 Сумма к оплате: 500 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}
	elseif($info_user['buyinfo'] == 'Vip'){
		$link->query("INSERT INTO `DON`() VALUES ()");	
		$id = $link->insert_id;
		$link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
        $id = $id + time();
		$id = $user_id.'_'.$id.'_Vip';
		$request_params = array( 
			'url' => 'https://oplata.qiwi.com/create?publicKey=48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPuf9Zdrc1jQTT9TGMk9vS46z7Lsh9Vs4wFvG6Mx2d1BhfLeyxt8PMgUtYeHYLaQjKXoTnzi3fxKwoupsJhkqs9EN2tC1TxibS8cMjsdL4x&amount=35.00&successUrl=vk.com&customFields[paySourcesFilter]=card&billId='.$id, 
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
		message($user_id,'⭐ Ты собираешься купить привилегию "VIP"<br><br>💶 Сумма к оплате: 35 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}
	elseif($info_user['buyinfo'] == 'Premium'){
		$link->query("INSERT INTO `DON`() VALUES ()");	
		$id = $link->insert_id;
		$link->query("DELETE FROM `DON` WHERE ID = '".$id."'");	
        $id = $id + time();
		$id = $user_id.'_'.$id.'_Premium';
		$request_params = array( 
			'url' => 'https://oplata.qiwi.com/create?publicKey=48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPuf9Zdrc1jQTT9TGMk9vS46z7Lsh9Vs4wFvG6Mx2d1BhfLeyxt8PMgUtYeHYLaQjKXoTnzi3fxKwoupsJhkqs9EN2tC1TxibS8cMjsdL4x&amount=20.00&successUrl=vk.com&customFields[paySourcesFilter]=card&billId='.$id, 
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
		message($user_id,'🔥 Ты собираешься купить привилегию "PREMIUM"<br><br>💶 Сумма к оплате: 20 рублей<br><br>❗Для оплаты перейди по ссылке: '.$ssilka,$kbd);
	}