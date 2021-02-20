<?php
/**
 * List of application payment status
 *
 * @return array
 */
function getPaymentStatus(){
	return [
		"UNPAID" => [
			'code' => 'un-paid',
			'text' => "Un Paid"
		],
		"PAID" => [
			'code' => 'paid',
			'text' => "Paid"
		],
		"INVOICED" => [
			'code' => 'invoiced',
			'text' => "Invoiced"
		],
		"PROCESSING" => [
			'code' => 'processing',
			'text' => "Processing"
		],
		"FAILED" => [
			'code' => 'failed',
			'text' => "Failed"
		]
	];
}

/**
 * Get list of payment status code
 *
 * @return array
 */
function getAllPaymentStatusCodes()
{
	return Arr::pluck(getPaymentStatus(), 'code');
}

/**
 * Get payment status text by code
 *
 * @param $code
 * @return string|null
 */
function getPaymentStatusText($code)
{
	foreach (getPaymentStatus() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

/**
 * Get payment status code by key
 *
 * @param $key
 * @return string|null
 */
function getPaymentStatusCode($key){
	$order_status = getPaymentStatus();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

/**
 * Get list of payment status codes by keys
 *
 * @param mixed ...$keys
 * @return array
 */

function getPaymentStatusCodes(...$keys){
	$order_status = getPaymentStatus();
	$codes = [];
	foreach($keys as $key){
		if (isset($order_status[$key])) {
			array_push($codes,  $order_status[$key]['code']);
		}
	}
	return $codes;
}
