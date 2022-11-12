<?php
	if (mysqli_num_rows($link->query("SELECT `user_id` FROM `user` WHERE user_id = '".$user_id."'")) > 0){
		$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));
		$c = 0;
	}
	else{
		$ref = $data->object->message->ref;
		$ref = explode('_', $ref);
		if($ref[1] == 'top'){
			$ref = $ref[0];
			$link->query("INSERT INTO `user`(`user_id`, `money`, `click`,`money_vivod`) VALUES ($user_id,'0','0','10')");	
			$link->query("INSERT INTO `ref_user`(`user_id`, `ref_user`) VALUES ($ref,'".$user_id."')");	
			message($ref,'🔥 Кто-то перешел по твоей реферальной ссылке, теперь ты сможешь получить 5% с его пополнений!');	
			$request_params = array( 
				'chat_id' => '-1001305813663', 
				'text' => "<b>☝ Clicker: РЕФЕРАЛ | 👶 ID: {$user_id} впервые зашел в бота!</b>", 
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
		} 
		else{
			$ref = $data->object->message->ref;
			if($ref > 0){
				$sql = $link->query("SELECT `user_id` FROM `user` WHERE user_id = '".$ref."'");  
				if (mysqli_num_rows($sql) > 0){
					$info_ref = mysqli_fetch_assoc($link->query("SELECT * FROM `ref` WHERE user_id = $ref"));
					$i = $info_ref['ref_score'] + 1;
					$link->query("UPDATE `ref` SET `ref_score`='$i' WHERE user_id = '".$ref."'");
					$link->query("INSERT INTO `user`(`user_id`, `money`, `click`,`ref_user`,`money_vivod`) VALUES ($user_id,'0','0','$ref','10')");
					message($ref,'🔥 Кто-то перешел по твоей реферальной ссылке!');	
				}
				$request_params = array( 
					'chat_id' => '-1001305813663', 
					'text' => "<b>☝ Clicker: РЕФЕРАЛ | 👶 ID: {$user_id} впервые зашел в бота!</b>", 
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
			}
			else{
				$request_params = array( 
					'chat_id' => '-1001305813663', 
					'text' => "<b>☝ Clicker: | 👶 ID: {$user_id} впервые зашел в бота!</b>", 
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
				$link->query("INSERT INTO `user`(`user_id`, `money`, `click`,`money_vivod`) VALUES ($user_id,'0','0','10')");
			}
		}
		$link->query("INSERT INTO `rassilka`(`user_id`) VALUES ($user_id)");
		$times = time() + (60*60*24*3);
		$link->query("INSERT INTO `onlime`(`user_id`, `check`) VALUES ($user_id,'".$times ."')");
		$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));
		$c = 1;
		require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
		message($user_id,'💶 Нажимай на кнопку "Клик" и начинай кликать свои первые мани 😜',$kbd);
		die('ok');
	}