<?php
	$query = "UPDATE `user` SET `peremen`='0' WHERE user_id = '".$user_id."'";
	$sql = mysqli_query ($link,$query);
	if($info_user['avto_click'] == 0){$color = 'negative';}else{$color = 'positive';}
	if($t > $info_user['bons_time']){
		$colorb = 'positive';
	}
	else{
		$colorb = 'negative';
	}
	if($user_id == '334626026' || $user_id == '243674541') {
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("👉🏻 Клик 👈🏻", COLOR_DEFAULT, 'Клик')],
				[getBtn("🖥 Майнинг 🖥", $color, 'Автокликер'),getBtn("Вывести", COLOR_PRIMARY, 'Вывести'),getBtn("📈 Улучшения 📈", COLOR_PRIMARY, 'Улучшения')],
				getBtna("👨‍💻‍", COLOR_DEFAULT, 'Профиль',"👑", COLOR_DEFAULT, 'Топ'),
				[getBtn("🔥 Рефералы 🔥", COLOR_PRIMARY, 'Рефералы')],
				[getBtn("👿 Выводы(адм) 👿", COLOR_PRIMARY, 'Вывод'),getBtn("👿 Ошибка(адм) 👿", COLOR_PRIMARY, 'Ошибка')],
			]
		];
	}
	else {
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("👉🏻 Клик 👈🏻", COLOR_DEFAULT, 'Клик')],
				[getBtn("🖥 Майнинг 🖥", $color, 'Автокликер'),getBtn("Вывести", COLOR_PRIMARY, 'Вывести'),getBtn("📈 Улучшения 📈", COLOR_PRIMARY, 'Улучшения')],
				getBtna("👨‍💻‍", COLOR_DEFAULT, 'Профиль',"👑", COLOR_DEFAULT, 'Топ'),
				[getBtn("🔥 Рефералы 🔥", COLOR_PRIMARY, 'Рефералы')],
			]
		];
	}
	