<?php
	if($info_user['peremen'] == 1){
		if (ctype_digit($info_message) === true){
			$link->query("UPDATE `user` SET `peremen`='0',`nomer`='".$info_message."' WHERE user_id = '".$user_id."'");	
			$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));	
			$kbd = [
				'one_time' => false,
				'buttons' => [
					[getBtn($info_user['nomer'], COLOR_PRIMARY, 'Выбор киви')],
					[getBtn("Изменить номер", COLOR_PRIMARY, 'Изменить номер')],
					[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
				]
			];
			message($user_id,'💰 Ты привязал свой киви кошелек',$kbd);		
		}
		else{
			message($user_id,'❗Номер киви кошелка не может состоять из букв, давай попробуем ещё раз:');
		}
	}
	elseif($info_user['peremen'] == 2) {
		if (ctype_digit($info_message) === true){
			if($info_user['money'] < $info_message) {
				message($user_id,'❗На счету недостаточно средств.');
				die('ok');mysqli_close($link);
			}
			elseif($info_message > 30 && $info_user['money_vivod'] > 30){
				$link->query ("UPDATE `user` SET money_vivod='30' WHERE user_id = $user_id");	
				message($user_id,'❗На счету недостаточно средств.');
				die('ok');mysqli_close($link);
			}
			elseif($info_message < 1){
				message($user_id,'❗Сумма не может быть меньше 0');
				die('ok');mysqli_close($link);
			}
			else {
				$symma = $info_user['money_vivod'] - $info_message;
				if($info_user['don_money'] > 0){$dons = $info_user['don_money'] - $info_message;}else{$dons = 0;}
				if($symma < 0){
					if($info_user['don_money'] != 0){
						message($user_id,'💰 Твоя сумма привышает лимит доступных рублей для ежедневного вывода, ты можешь вывести: '.$info_user['money_vivod'].' р');
					}
					else{
						message($user_id,'💰 Твоя сумма привышает лимит доступных рублей для ежедневного вывода, ты можешь вывести: '.$info_user['money_vivod'].' р<br>❗У тебя есть возможность увеличить лимит пополнив свой баланс');
					}
					die('ok');mysqli_close($link);
				}
				if($dons < 0 && $info_user['donate'] == 1){
					if($info_user['don_money'] != 0){
						message($user_id,'💰 Твоя сумма привышает лимит доступных рублей для ежедневного вывода, ты можешь вывести: '.$info_user['don_money'].' р');
					}
					else{
						message($user_id,'💰 Твоя сумма привышает лимит доступных рублей для ежедневного вывода, ты можешь вывести: '.$info_user['don_money'].' р<br>❗У тебя есть возможность увеличить лимит пополнив свой баланс');
					}
					die('ok');mysqli_close($link);
				}
				else{
					$link->query("UPDATE `user` SET `don_money`='".$dons."' WHERE user_id = '".$user_id."'");
					if($info_user['money_vivod'] > 30){
						$link->query ("UPDATE `user` SET money_vivod='30' WHERE user_id = $user_id");	
						$info_user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));
						$symma = $info_user['money_vivod'] - $info_message;
					}
					if($symma < 1){
						$time = time() + (60*60*24);
						$link->query ("UPDATE `user` SET `time_vivod`='".$time."' WHERE user_id = $user_id");	
					}
					$vxod = $info_user['money'] - $info_message;
					$nomer = $info_user['nomer'];
					$link->query ("UPDATE `user` SET `vivod_lol`='".$info_message."',`peremen`=0,money='".$vxod."',money_vivod='".$symma."' WHERE user_id = $user_id");	
					require_once('menu_load.php');
					if($symma < 1){
						message($user_id,'✅ Ты успешно подал заявку на вывод, в течение 12ч тебе придут деньги!',$kbd);
					}
					else{
						message($user_id,'✅ Ты успешно подал заявку на вывод, в течение 12ч тебе придут деньги!',$kbd);
					}
					if($dons < 1){
						if($info_user['donate'] != 0){
							$time = time() + (60*60*24);
							$link->query ("UPDATE `user` SET `lll`='1',`money_vivod`='0',`time_vivod`='".$time."' WHERE user_id = $user_id");
						}
					}
					$request_params = array( 
						'chat_id' => '-1001305813663', 
						'text' => "<b>☝ Clicker: | 👿 ID: {$user_id} подал вывод на {$info_message} | {$symma} рублей! Киви: {$nomer}</b>", 
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
					die('ok');mysqli_close($link);
				}
			}
		}
		else{
			message($user_id,'❗Сумма вывода не может состоять из копеек или же букв, давай попробуем ещё раз:');
		}
	}
	elseif($info_user['peremen'] == 3) {
		if (ctype_digit($info_message) === true){
			$kbd = [
				'one_time' => false,
				'buttons' => [
					[getBtn($info_message, COLOR_PRIMARY, 'Выбор киви')],
					[getBtn("Изменить номер", COLOR_PRIMARY, 'Изменить номер')],
					[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
				]
			];
			message($user_id,'💰 Ты изменил свой киви кошелек',$kbd);
			$link->query("UPDATE `user` SET `peremen`='0',`nomer`='".$info_message."' WHERE user_id = '".$user_id."'");			
		}
		else{
			message($user_id,'❗Номер киви кошелка не может состоять из букв, давай попробуем ещё раз:');
		}
	}
	elseif($info_user['peremen'] == 4) {
		$link->query ("UPDATE `user` SET `peremen`='0',`otziv`='0',`vivod_lol`='0' WHERE user_id = $info_message");
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Оставил", COLOR_positive, 'Оставил')],
				[getBtn("Пропустить", COLOR_NEGATIVE, 'Пропустить')],
			]
		];
		message($info_message,'✅Деньги были отправлены на твой счет, проверяй!<br><br>💰 Пожалуйста оставь отзыв, нам это очень важно!<br><br>❗Если ты не оставишь отзыв, то мы дадим тебе штраф в виде 4 часов до следующего вывода, это будет наша обида на тебя(<br><br>Отзыв нужна оставлять тут: https://vk.com/topic-192902863_41854905',$kbd);
		message($user_id,'Готово!');
	}
	elseif($info_user['peremen'] == 5) {
		$info_user1 = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $info_message"));
		$link->query ("UPDATE `user` SET `peremen`='0' WHERE user_id = $user_id");
		$summ = $info_user1['money'] + $info_user1['vivod_lol'];
		$summ1 = $info_user1['money_vivod'] + $info_user1['vivod_lol'];
		$link->query ("UPDATE `user` SET `money_vivod`='".$summ1."',`vivod_lol`='0',`money`='".$summ."' WHERE user_id = $info_message");
		message($info_message,'❗Во время перевода произошла ошибка, возможно вы указали неверный киви кошелёк или же ваш кошелёк не идентифицирован. Деньги вернуться вам на баланс.');
		message($user_id,'Готово!');
	}
	/*if($info_user['vivod'] == 2){
		if (ctype_digit($info_message) === true){
			if($info_user['money'] >= $info_message && $info_message != '0'){
				require_once('menu_load.php');
				$request_params = array( 
					'message' => '✅ Я перевел тебе деньги, проверь свой киви!<br><br>📝 Не забудь оставить отзыв в нашем обсуждении - https://vk.com/topic-192372428_40969508', 
					'user_id' => $user_id, 
					'keyboard' => json_encode($kbd, JSON_UNESCAPED_UNICODE),
					'access_token' => $token, 
					'v' => '5.80'
				); 
				$get_params = http_build_query($request_params); 
				file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
				$phone  = '79080430214';
				$tokens = '61cfd2c0006e151f08cb60ff9e26d563';
				$c = mb_substr($info_user['nomer'],0,1,'utf-8');
				if($c == '8'){
					$c = substr($info_user['nomer'], 1);
					$c = '7'.$c;
				}
				else{
					$c = $info_user['nomer'];
				}
				$api = new Qiwi($phone, $tokens);
				$info_qiwi = $api->sendMoneyToQiwi([
					'id' => date("YmdHis"),
					'sum' => [
						'amount' => $info_message,
						'currency' => '643'
					], 
					'paymentMethod' => [
						'type' => 'Account',
						'accountId' => '643'
					],
					'comment' => 'Money Click Bot',
					'fields' => [
						'account' => $c
					]

				]);
				$vxod = $info_user['money'] - $info_message;
				$query = "UPDATE `user` SET `vivod`=0,`nomer`='',money='$vxod' WHERE user_id = $user_id";
				$sql = mysqli_query ($link,$query);	
				$info_qiwi = $api->getBalance();
				$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.0")); 
				$name_name = $user_info->response[0]->first_name; 
				$name_famely = $user_info->response[0]->last_name; 
				$name_full = $name_name.' '.$name_famely;
				$request_params = array( 
					'message' => '👉🏻💸 | @id'.$info_user['user_id'].' ('.$name_full.') вывел сумму "'.$info_message.'" рублей баланс "'.$info_qiwi['accounts'][0]['balance']['amount'].'" рублей', 
					'peer_id' => '2000000001', 
					'access_token' => 'ccc46a25ce30ee858fdac20869f11fe802ec604bbd011a63c7cd29ed48f5ddd95ee1a3173b231cae3402d', 
					'v' => '5.80'
				); 
				$get_params = http_build_query($request_params); 
				file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
			}
			else{
				$request_params = array( 
					'message' => '✖ Недостаточно средст, попробуй ещё раз:', 
					'user_id' => $user_id, 
					'access_token' => $token,  
					'v' => '5.80'
				); 
				$get_params = http_build_query($request_params); 
				file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
			}
		}
		else{
			$request_params = array( 
				'message' => '✖ Сумму не может состоять из копеек или же из букв!', 
				'user_id' => $user_id, 
				'access_token' => $token,  
				'v' => '5.80'
			); 
			$get_params = http_build_query($request_params); 
			file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
		}
	}*/