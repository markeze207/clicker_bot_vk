<?php
	$colorp = 'default';
	$colorv = 'default';
	$color = 'default';
	if($info_user['stats'] == 1){
		$colorp = 'default';
		$colorv = 'primary';
	}
	elseif($info_user['stats'] == 2){
		$colorv = 'default';
		$colorp = 'primary';
	}
	elseif($info_user['stats'] == 3){
		$colorv = 'default';
		$colorp = 'default';
		$colora = 'primary';
	}
	if($info_user['avto_click'] > 0) {
		$color = 'primary';
	}
	$kbd = [
		'one_time' => false,
		'buttons' => [
			[getBtn("👑 ADMIN 👑", $colora, 'Admin')],
			getBtna("⭐️ VIP ⭐️", $colorv, 'VIP',"🔥 PREMIUM 🔥", $colorp, 'Premium'),
			[getBtn("🖥 Майнинг ферма 🖥", $color, 'Купить майнинг ферму')],
			[getBtn("Вернуться назад", COLOR_DEFAULT, 'Вернуться назад')],
		]
	];
	message($user_id,'1) ADMIN 👑 - 500 Рублей 💶 (клик 0.5 руб)<br><br>2) VIP ⭐️ - 35 Рублей 💶 (клик 0.005 руб)<br><br>3) PREMIUM 🔥 - 20 рублей 💶 (клик 0.0035 руб)<br><br>4)Майнинг ферма 🖥 - 30 Рублей 💶 (Приносит ежедневный доход в размере 1.2 руб, количество ферм неограниченно)',$kbd);