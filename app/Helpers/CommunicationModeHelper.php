<?php
function getCommunicationModes(){
	return [
		"PORTAL" => [
			'code' => 'portal',
			'text' => "Portal"
		],
		"EMAIL" => [
			'code' => 'email',
			'text' => "Email"
		]
	];
}

function getAllCommunicationModeCodes()
{
	return Arr::pluck(getCommunicationModes(), 'code');
}

function getCommunicationModeText($code)
{
	foreach (getCommunicationModes() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

function getCommunicationModeCode($key){
	$order_status = getCommunicationModes();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

function getCommunicationModeCodes(...$keys){
	$order_status = getCommunicationModes();
	$codes = [];
	foreach($keys as $key){
		if (isset($order_status[$key])) {
			array_push($codes,  $order_status[$key]['code']);
		}
	}
	return $codes;
}
