<?php
	if($info_user['money'] >= 1){
		if($info_user['money_vivod'] < 1){
			if($info_user['lll'] == 0){
				$min = $info_user['time_vivod'] - time();
				message($user_id,'❗Следующий вывод ты сможешь сделать через '.secToStr($min));
			}
			else{
				$request_params = array( 
					'url' => 'vk.com/write-'.$grup_id .'?ref='.$user_id.'_top', 
					'access_token' => $token, 
					'private' => '0',
					'v' => '5.111'
				); 
				$get_params = http_build_query($request_params); 
				$info_vixod = file_get_contents('https://api.vk.com/method/utils.getShortLink?'. $get_params); 
				$json = json_decode($info_vixod,true);
				$ssilka = $json['response']['short_url'];
				message($user_id,'❤️ Ты полностью прошел нашего бота!<br>💰Теперь ты можешь зарабатывать 5% с пополнений людей которые перейдут по твоей ссылке и выводить их: '.$ssilka);
			}
		}
		else{
			if($info_user['nomer'] == '') {
				$kbd = [
					'one_time' => false,
					'buttons' => [
						[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
					]
				];
				$link->query("UPDATE `user` SET `peremen`='1' WHERE user_id = '".$user_id."'");
				message($user_id,'❗Для начало привяжи свой киви кошелек<br><br>💶 Для того чтобы его привязать, отправь мне номер своего киви:',$kbd);
			}
			else{
				$kbd = [
					'one_time' => false,
					'buttons' => [
						[getBtn($info_user['nomer'], COLOR_PRIMARY, 'Выбор киви')],
						[getBtn("Изменить номер", COLOR_PRIMARY, 'Изменить номер')],
						[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
					]
				];
				message($user_id,'❗Выбери номер киви кошелька на который будем совершать вывод:',$kbd);
				$link->query("UPDATE `user` SET `peremen`='0' WHERE user_id = '".$user_id."'");
			}
		}
	}
	else{
		message($user_id,'❤ Вывод станет доступный когда на твоем балансе будет не меньше 1 рубля');
		$link->query("UPDATE `user` SET `peremen`='0' WHERE user_id = '".$user_id."'");
	}