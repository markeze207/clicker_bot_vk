<?php
$p = 'Нет';
	if($info_user['stats'] == 1){
		$p = 'VIP';
	}
	elseif($info_user['stats'] == 2){
		$p = 'PREMIUM';
	}
	elseif($info_user['stat'] == 3) {
		$p = 'ADMIN';
	}
	if($info_user['avto_click'] == 0){
		$text = 'Нет';
	}
	$result = mysqli_query($link,"SELECT `click`,`user_id` FROM `user` ORDER BY `click` DESC LIMIT 200000"); // запрос на выборку
	$top = 0;
	while($row = mysqli_fetch_array($result)){
		$top += 1;
		if($row['user_id'] == $info_user['user_id']){
			$tops = $top;
			continue;
		}
	}
	message($user_id,'👑 Статус: '.$p.'<br><br>💶 Баланс: '.$info_user['money'].' рублей<br>📈 Место в топе: '.$tops.'<br>👉🏻 Кликов: '.$info_user['click'].'<br>🖥 Майнинг ферм: '.$info_user['avto_click']);