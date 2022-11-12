<?php
	$info_user = mysqli_fetch_assoc(mysqli_query($link,"SELECT stats FROM `user` WHERE user_id = $user_id"));
	if($info_user['stats'] == 2){
		message($user_id,'❗ У тебя уже имеется данная привилегия!');
	}
	elseif($info_user['stats'] == 1){
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Да", COLOR_positive, 'ТочноУлучшить')],
				[getBtn("Вернуться назад", COLOR_DEFAULT, 'Улучшения')],
			]
		];
		message($user_id,'❗В данный момент у тебя есть другая привилегия!<br>📄 При покупки новой привилегии ты потеряешь старую, ты точно уверен?',$kbd);
		$query = "UPDATE `user` SET `buyinfo`='Premium' WHERE user_id = '".$user_id."'";
		$sql = mysqli_query ($link,$query);
	}
	else{
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
		$query = "UPDATE `user` SET `buyinfo`='Premium' WHERE user_id = '".$user_id."'";
		$sql = mysqli_query ($link,$query);
	}