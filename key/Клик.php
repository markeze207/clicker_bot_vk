<?php
	$rand = rand(1,2);
	if($rand == 1){
		usleep(80000);
	}
	else{
		usleep(90000);
	}
	if($info_user['stats'] == 0){
		$rand = rand(1,2);
		if($rand == 1){
			$plis = '0.001';
			if($info_user['ref_user'] != 0){
				$info_ref = mysqli_fetch_assoc($link->query("SELECT money FROM `user` WHERE user_id = '".$info_user['ref_user']."'"));
				$money = '0.0005';
				$link->query ("UPDATE `user` SET `money`='".($info_ref['money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
				$info_ref = mysqli_fetch_assoc($link->query("SELECT ref_money FROM `ref` WHERE user_id = '".$info_user['ref_user']."'"));
				$link->query ("UPDATE `ref` SET `ref_money`='".($info_ref['ref_money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
			}
		}
		else{
			$plis = '0.002';
			if($info_user['ref_user'] != 0){
				$info_ref = mysqli_fetch_assoc($link->query("SELECT money FROM `user` WHERE user_id = '".$info_user['ref_user']."'"));
				$money = '0.0005';
				$link->query ("UPDATE `user` SET `money`='".($info_ref['money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
				$info_ref = mysqli_fetch_assoc($link->query("SELECT ref_money FROM `ref` WHERE user_id = '".$info_user['ref_user']."'"));
				$link->query ("UPDATE `ref` SET `ref_money`='".($info_ref['ref_money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
			}
		}
	}
	elseif($info_user['stats'] == 1){
		$plis = '0.005';
		if($info_user['ref_user'] != 0){
			$money = '0.0025';
			$info_ref = mysqli_fetch_assoc($link->query("SELECT money FROM `user` WHERE user_id = '".$info_user['ref_user']."'"));
			$link->query ("UPDATE `user` SET `money`='".($info_ref['money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
			$info_ref = mysqli_fetch_assoc($link->query("SELECT ref_money FROM `ref` WHERE user_id = '".$info_user['ref_user']."'"));
			$link->query ("UPDATE `ref` SET `ref_money`='".($info_ref['ref_money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
		}
	}
	elseif($info_user['stats'] == 2){
		$plis = '0.0035';
		if($info_user['ref_user'] != 0){
			$money = '0.0017';
			$info_ref = mysqli_fetch_assoc($link->query("SELECT money FROM `user` WHERE user_id = '".$info_user['ref_user']."'"));
			$link->query ("UPDATE `user` SET `money`='".($info_ref['money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
			$info_ref = mysqli_fetch_assoc($link->query("SELECT ref_money FROM `ref` WHERE user_id = '".$info_user['ref_user']."'"));
			$link->query ("UPDATE `ref` SET `ref_money`='".($info_ref['ref_money'] + $money)."' WHERE user_id = '".$info_user['ref_user']."'");
		}
	}
	elseif($info_user['stats'] == 3){
		$plis = '0.5';
	}
	$info_onlime = mysqli_fetch_assoc($link->query("SELECT click FROM `onlime` WHERE user_id = $user_id"));
	$balans = $info_user['money'] + $plis;
	$click = $info_user['click'] + 1;
	$clicks = $info_onlime['click'] + 1;
	if($clicks > 999){
		$times = time() + (60*60*24*3);
		$link->query ("UPDATE `onlime` SET `click`='0',`check`='".$times."',`message`='0' WHERE user_id = '".$user_id."'");
	}
	else{
		$link->query ("UPDATE `onlime` SET `click`='$clicks' WHERE user_id = '".$user_id."'");
	}
	$link->query ("UPDATE `user` SET `money`='$balans',`click`='$click' WHERE user_id = '".$user_id."'");
	$result = $link->query("SELECT * FROM `user`");
	while($row = mysqli_fetch_array($result)){
		$cliks += $row['click'];
	}
	$result1 = $link->query("SELECT * FROM `rassilka`");
	while($row = mysqli_fetch_array($result1)){
		$pl += 1;
	}
	require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
	message($user_id,'💰Накликай себе на МакКомбо<br>
	💶 Баланс: '.$balans.' рублей
	👉🏻 Всего кликов: '.$cliks.' 
	👨‍💻 Ваши клики: '.$click.' 
	👨‍👧‍👦 Всего игроков: '.$pl.'',$kbd);