<? 
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("Вернуться назад", COLOR_DEFAULT, 'Вывести')],
    ]
];
message($user_id,'💶 Отлично, а теперь укажи сумму которую хочешь вывести:',$kbd);
$link->query("UPDATE `user` SET `peremen`='2' WHERE user_id = '".$user_id."'");