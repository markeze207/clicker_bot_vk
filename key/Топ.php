<?php
	$result = mysqli_query($link,"SELECT user_id,name,click FROM `user` ORDER BY `click` DESC LIMIT 0, 10"); // запрос на выборку
	$top = 0;
	while($row = mysqli_fetch_array($result)){
		$top += 1;
		if($top == 10){
			$infsa = $infss;
			$infss = $infsa.'<br>🔟 @id'.$row['user_id'].' ('.$row['name'].') | 👉🏻 Кликов:'.$row['click'];
		}
		else{
			$infsa = $infss;
			$infss = $infsa.'<br>'.$top.'⃣ @id'.$row['user_id'].' ('.$row['name'].') | 👉🏻 Кликов: '.$row['click'];
		}
	}
	$cmd = 1;
	message($user_id,$infss.$ifs.$ifsss);
?>