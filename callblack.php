<?php 
$data = json_decode(file_get_contents('php://input')); 
$grup_id = $data->group_id; 
$token = 'bf2e917f64aba4120d60128a57d8403982fe9e0abf2751b2245c9b5576fd75cbed7e5c3ecd7bae4dece1b';
require_once('/home/user2/sites/lillego.tk/clicker/public.php');
$promo_99  = $data->type.'.php';
if($data->type == 'message_new'){
	$link = new mysqli('localhost', 'root', '', 'clicker');
	$user_id = $data->object->message->from_id; 
	$peer_id = $data->object->message->peer_id; 
	$info_message = $data->object->message->text; 
	$payload = $data->object->message->payload;
	$json_1 = json_decode(file_get_contents('php://input'),true);
	require_once('/home/user2/sites/lillego.tk/clicker/load_reg_user.php');
	if($peer_id == $user_id){
		if($payload != ''){
			$payload = json_decode($payload, true);
			if(isset($payload['command']) == 'true' || $c == 1){
				require_once('/home/user2/sites/lillego.tk/clicker/menu_load.php');
				message($user_id,'💶 Нажимай на кнопку "Клик" и начинай кликать свои первые мани 😜',$kbd);
				$cmd = 1;
				mysqli_close($link);
				die('ok');

			}
			else{
				$promo_99  = '/home/user2/sites/lillego.tk/clicker/key/'.$payload.'.php';
				if(file_exists($promo_99)) {
					require_once($promo_99);
					$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.111")); 
					$name_name = $user_info->response[0]->first_name; 
					$name_famely = $user_info->response[0]->last_name; 
					$name_full = $name_name.' '.$name_famely;
					if($info_user['name'] != $name_full){
						$link->query("UPDATE `user` SET `name`='".$name_full."' WHERE user_id = '".$user_id."'");
					}
					$cmd = 1;
					mysqli_close($link);
					die('ok');
				}	
			}
		}
		elseif($info_user['peremen'] != 0){
			require_once('/home/user2/sites/lillego.tk/clicker/peremen.php');
			mysqli_close($link);
			die('ok');
		}
	}
	mysqli_close($link);
	die('ok');
}
elseif($data->type == "board_post_new") {
	$link = new mysqli('localhost', 'root', 'OXc2TMifn35T3XCF', 'clicker');
	$user_id = $data->object->from_id;
	$text = $data->object->text;
	$link->query ("UPDATE `user` SET `otziv`='1' WHERE user_id = $user_id");
	$request_params = array( 
		'chat_id' => '-1001305813663',
		'text' => "<b>☝ Clicker: | ✏ ID: {$user_id} оставил отзыв: {$text}</b>", 
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
	mysqli_close($link);
	die('ok');
}
else{
	$promo_99  = $data->type.'.php';
	if(file_exists($promo_99)){
		require_once($promo_99);
	}
	else{
		die('ok');
	}
}