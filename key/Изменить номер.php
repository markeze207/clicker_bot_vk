<? 
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("Вернуться назад", COLOR_DEFAULT, 'Вывести')],
    ]
];
message($user_id,'💰 Укажи новый номер своего киви кошелька:',$kbd);
$link->query("UPDATE `user` SET `peremen`='3' WHERE user_id = '".$user_id."'");