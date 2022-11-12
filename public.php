<?php
const COLOR_PRIMARY = 'primary';
const COLOR_NEGATIVE = 'negative';
const COLOR_positive = 'positive';
const COLOR_DEFAULT = 'default';
class Qiwi {
	private $_phone;
	private $_token;
	private $_url;
 
	function __construct($phone, $token) {
		$this->_phone = $phone;
		$this->_token = $token;
		$this->_url   = 'https://edge.qiwi.com/';
	}
	private function sendRequest($method, array $content = [], $post = false) {
		$ch = curl_init();
		if ($post) {
			curl_setopt($ch, CURLOPT_URL, $this->_url . $method);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
		} else {
			curl_setopt($ch, CURLOPT_URL, $this->_url . $method . '/?' . http_build_query($content));
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->_token,
			'Host: edge.qiwi.com'
		]); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result, 1);
	}
	public function getPaymentsHistory(Array $params = []) {
		return $this->sendRequest('payment-history/v2/persons/' . $this->_phone . '/payments', $params);
	}
	public function sendMoneyToQiwi(Array $params = []) {
		return $this->sendRequest('sinap/api/v2/terms/99/payments', $params, 1);
	}
	public function getBalance() {
		return $this->sendRequest('funding-sources/v2/persons/' . $this->_phone . '/accounts');
	}
}
function getBtnlink($label, $color, $payload) {
    return [
        'action' => [
			'type' => 'open_link',
			'link' =>  $payload,
            'label' => $label
        ],
    ];
}
function message($user_id, $text = '', $kbd = '', $photo = '') {
	$token = $GLOBALS['token'];
	if($kbd != ''){
		if($photo != ''){
			$request_params = array( 
				'message' => $text, 
				'peer_id' => $user_id, 
				'keyboard' => json_encode($kbd, JSON_UNESCAPED_UNICODE),
				'access_token' => $token, 
				'random_id' => '0',
				'v' => '5.111',
				'attachment' => $photo,
			); 
			$date = http_build_query($request_params); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
			curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			return $result;
		}
		else{
			$request_params = array( 
				'message' => $text, 
				'peer_id' => $user_id, 
				'keyboard' => json_encode($kbd, JSON_UNESCAPED_UNICODE),
				'access_token' => $token, 
				'random_id' => '0',
				'v' => '5.111',
			); 
			$date = http_build_query($request_params); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
			curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			return $result;
		}
	}
	elseif($photo != ''){
		$request_params = array( 
			'message' => $text, 
			'peer_id' => $user_id, 
			'access_token' => $token, 
			'random_id' => '0',
			'v' => '5.111',
			'attachment' => $photo,
		); 
		$date = http_build_query($request_params); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
		curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return $result;
	}
	else{
		$request_params = array( 
			'message' => $text, 
			'peer_id' => $user_id, 
			'access_token' => $token, 
			'random_id' => '0',
			'v' => '5.111',
		); 
		$date = http_build_query($request_params); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
		curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return $result;
	}
}

function num_word($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}
function getBtn($label, $color, $payload = '') {
    return [
        'action' => [
            'type' => 'text',
            "payload" => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'label' => $label
        ],
        'color' => $color
    ];
}
function getBtna($label, $color, $payload = '',$label_1, $color_1, $payload_1 = '') {
	return 	[
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE),
			'label' => $label
		],
		'color' => $color,
	],
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload_1, JSON_UNESCAPED_UNICODE),
			'label' => $label_1
		],
		'color' => $color_1,
	],
	];
}
function getBtn_3($label, $color, $payload = '',$label_1, $color_1, $payload_1 = '',$label_2, $color_2, $payload_2 = '') {
	return 	[
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE),
			'label' => $label
		],
		'color' => $color,
	],
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload_1, JSON_UNESCAPED_UNICODE),
			'label' => $label_1
		],
		'color' => $color_1,
	],
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload_2, JSON_UNESCAPED_UNICODE),
			'label' => $label_2
		],
		'color' => $color_2,
	],
	];
}