<?php
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

function getAllPaymentStatusCodes()
{
	return Arr::pluck(getPaymentStatus(), 'code');
}

function getPaymentStatusText($code)
{
	foreach (getPaymentStatus() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

function getPaymentStatusCode($key){
	$order_status = getPaymentStatus();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

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
