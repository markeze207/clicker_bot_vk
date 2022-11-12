<?php
	$info_user = mysqli_fetch_assoc(mysqli_query($link,"SELECT buyinfo FROM `user` WHERE user_id = $user_id"));
	if($info_user['buyinfo'] == 'Admin'){
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Банковская карта", COLOR_PRIMARY, 'Банковская карта'),getBtn("Qiwi", COLOR_PRIMARY, 'Qiwi')],
				[getBtn("Вернуться назад", COLOR_DEFAULT, 'Улучшения')],
			]
		];
		message($user_id,'❗Выбери способ пополнения:',$kbd);
	}
	elseif($info_user['buyinfo'] == 'Vip'){
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Банковская карта", COLOR_PRIMARY, 'Банковская карта'),getBtn("Qiwi", COLOR_PRIMARY, 'Qiwi')],
				[getBtn("Вернуться назад", COLOR_DEFAULT, 'Улучшения')],
			]
		];
		message($user_id,'❗Выбери способ пополнения:',$kbd);
	}
	elseif($info_user['buyinfo'] == 'Premium'){
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Банковская карта", COLOR_PRIMARY, 'Банковская карта'),getBtn("Qiwi", COLOR_PRIMARY, 'Qiwi')],
				[getBtn("Вернуться назад", COLOR_DEFAULT, 'Улучшения')],
			]
		];
		message($user_id,'❗Выбери способ пополнения:',$kbd);
	}