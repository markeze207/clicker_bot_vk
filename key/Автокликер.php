<?php
	if($info_user['avto_click'] == 0){
		$text = '💶 Пока ещё у тебя нет майнинг фермы, но ты можешь купить её в улучшениях.';
		$kbd = [
			'one_time' => false,
			'inline' => true,
			'buttons' => [
				[getBtn("Улучшения", COLOR_positive, 'Улучшения')],
			]
		];
		message($user_id,$text,$kbd);
	}
	else{
		$min = $info_user['avto_click_time'] - time();
		$money = 1.2 * $info_user['avto_click'];
		$text = '🖥 Майнинг ферма | Количество ферм: '.$info_user['avto_click'].'<br><br>💶 Баланс майнинг фермы: '.$info_user['avto_click_money'].' рублей<br>💰 Доход каждые 24 часа: '.$money.' руб<br><br>👉🏻 Следующие пополнения майнинг фермы: '.secToStr($min).'<br><br>📄 Чтобы увеличить доход майнинг фермы, купить ещё ферм.';
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Собрать", COLOR_PRIMARY, 'Собрать майнинг ферма')],
				[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
			]
		];
		message($user_id,$text,$kbd);
	}