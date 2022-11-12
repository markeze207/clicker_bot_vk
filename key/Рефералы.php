<?php
	$query = "SELECT `user_id` FROM `ref` WHERE user_id = '".$user_id."'";
	$sql = mysqli_query ($link,$query);  
	if (mysqli_num_rows($sql) > 0){
		$info_ref = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `ref` WHERE user_id = $user_id"));
		$c = 0;
	}
	else{
		$query = "INSERT INTO `ref`(`user_id`, `ref_ssilka`) VALUES ($user_id,'$ssilka')";	
		$result =  mysqli_query($link,$query);
		$info_ref = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `ref` WHERE user_id = $user_id"));
		$c = 1;
	}
	$request_params = array( 
		'url' => 'vk.com/write-'.$grup_id .'?ref='.$user_id, 
		'access_token' => $token, 
		'private' => '0',
		'v' => '5.111'
	); 
	$get_params = http_build_query($request_params); 
	$info_vixod = file_get_contents('https://api.vk.com/method/utils.getShortLink?'. $get_params); 
	$json = json_decode($info_vixod,true);
	$ssilka = $json['response']['short_url'];
	message($user_id,'✅ Приглашено уже: '.$info_ref['ref_score'].'<br>💶 Заработано с рефералов: '.$info_ref['ref_money'].' р <br><br>❗ Реферальная ссылка: '.$ssilka.'<br><br>💰 Приводи своих друзей и получай за их клики 50%, твои друзья кликают а ты с них имеешь постоянный доход!');