<?php
/**
 * List for all communication modes
 *
 * @return array
 */
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

/**
 * Get list of communication mode code
 *
 * @return array
 */
function getAllCommunicationModeCodes()
{
	return Arr::pluck(getCommunicationModes(), 'code');
}

/**
 * Get communication mode text by code
 *
 * @param $code
 * @return string|null
 */
function getCommunicationModeText($code)
{
	foreach (getCommunicationModes() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

/**
 * Get communication mode code by key
 *
 * @param $key
 * @return string|null
 */
function getCommunicationModeCode($key){
	$order_status = getCommunicationModes();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

/**
 * Get list of communication mode codes by keys
 *
 * @param mixed ...$keys
 * @return array
 */
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
