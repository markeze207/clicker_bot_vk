<?php
	$info_user = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `user` WHERE user_id = $user_id"));
	if($info_user['avto_click_money'] > 0){
		message($user_id,'💶 Ты собрал '.$info_user['avto_click_money'].' р');
		$money = $info_user['money'] + $info_user['avto_click_money'];
		$query = "UPDATE `user` SET `avto_click_money`='0',`money`='$money' WHERE user_id = '".$user_id."'";
		$sql = mysqli_query ($link,$query);
	}
	else{
		$min = $info_user['avto_click_time'] - time();
		message($user_id,'🖥 Баланс майнинг фермы пуст, приходи через '.secToStr($min));
	}