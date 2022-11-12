<?php
	$token = 'bf2e917f64aba4120d60128a57d8403982fe9e0abf2751b2245c9b5576fd75cbed7e5c3ecd7bae4dece1b';
	require_once('/home/user2/sites/lillego.tk/clicker/public.php');
	$link = new mysqli('localhost', 'root', 'OXc2TMifn35T3XCF', 'clicker');
	$result = mysqli_query($link,"SELECT * FROM `user` WHERE avto_click != 0"); // запрос на выборку
	while($row = mysqli_fetch_array($result))
	{;
		if(time() > $row['avto_click_time']){
			$money = 1.2 * $row['avto_click'];
			if($money != $row['avto_click_money']){
				$money += $row['avto_click_money'];
				$nextWeek = time() + 3600;
				$link->query("UPDATE `user` SET `avto_click_time`='$nextWeek',`avto_click_money`='$money' WHERE user_id = '".$row['user_id']."'");
			}
			else{
				$nextWeek = time() + 3600;
				$link->query("UPDATE `user` SET `avto_click_time`='$nextWeek' WHERE user_id = '".$row['user_id']."'");
			}
		}
	}
	$resultf = mysqli_query($link,"SELECT * FROM `user` WHERE time_vivod < '".(time())."' AND money_vivod = 0"); // запрос на выборку
	while($row = mysqli_fetch_array($resultf))
	{;
		if($row['time_vivod'] < time()){
			if($row['don_money'] != 0){
				if($row['lll'] == 1){
					if($row['don_money'] > 30){
						$link->query("UPDATE `user` SET `money_vivod`='30' WHERE user_id = '".$row['user_id']."'");
					}
					else{
						$link->query("UPDATE `user` SET `money_vivod`='".$row['don_money']."' WHERE user_id = '".$row['user_id']."'");
					}
				}
				else{
					$link->query("UPDATE `user` SET `money_vivod`='30' WHERE user_id = '".$row['user_id']."'");
				}
			}
			else{
				if($row['lll'] == 1){
					$link->query("UPDATE `user` SET `money_vivod`='0' WHERE user_id = '".$row['user_id']."'");
				}
				else{
					$link->query("UPDATE `user` SET `money_vivod`='10' WHERE user_id = '".$row['user_id']."'");
				}
			}
		}
	}
	$times = time() + (60*60*2);
	$results = mysqli_query($link,"SELECT * FROM `onlime` WHERE 1"); // запрос на выборку
	while($row = mysqli_fetch_array($results))
	{;
		if($times > $row['check']){
			if($row['message'] == 0){
				message($row['user_id'],'❗ВНИМАНИЕ, ты за 3 дня сделал менее 1к кликов что противоречит правилам нашего бота. Ты можешь потерять свой игровой процесс через 2 часа. Поэтому активизируйся !');
				$link->query("UPDATE `onlime` SET `message`='1' WHERE user_id = '".$row['user_id']."'");
			}
			else{
				if($row['check'] < time()){
					$info_del = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = '".$row['user_id']."'"));
					$link->query ("DELETE FROM `user` WHERE user_id = '".$row['user_id']."'");
					$link->query ("DELETE FROM `ref` WHERE user_id = '".$row['user_id']."'");
					$link->query ("DELETE FROM `ref_user` WHERE user_id = '".$row['user_id']."'");
					$link->query ("DELETE FROM `onlime` WHERE user_id = '".$row['user_id']."'");
					$info_money = mysqli_fetch_assoc($link->query("SELECT money FROM `log` WHERE ID = '1'"));
					$money = $info_money['money'] + $info_del['don_money'];
					$link->query("UPDATE `log` SET `money`='".$money."' WHERE user_id = '".$row['user_id']."'");
				}
			}
		}
	}
	$phone  = '79517862267';
	$token = '7983d26264eff22b3036c0ef4df2307a';
	
	$api = new Qiwi($phone, $token);
	$info_qiwi = $api->getBalance();
	$balans = $info_qiwi['accounts'][0]['balance']['amount'];
	echo $balans;
	if($balans < 30){
		$phones  = '79995885725';
		$tokens = '647214e707ddfd2da2fd23d41b95b33d';
		$apis = new Qiwi($phones, $tokens);
		$info_qiwi = $apis->sendMoneyToQiwi([
			'id' => date("YmdHis"),
			'sum' => [
				'amount' => 100,
				'currency' => '643'
			], 
			'paymentMethod' => [
				'type' => 'Account',
				'accountId' => '643'
			],
			'comment' => '',
			'fields' => [
				'account' => '79517862267'
			]

		]); 
	}
	mysqli_close($link);