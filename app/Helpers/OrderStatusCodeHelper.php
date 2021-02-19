<?php
function getOrderStatusList(){
	return [
		"NEW" => [
			'code' => 1,
			'text' => "Yet to Start"
		],
		"IN_PROGRESS" => [
			'code' => 2,
			'text' => "Working"
		],
		"DELIVERED" => [
			'code' => 3,
			'text' => "Delivered"
		],
		"IN_REVIEW" => [
			'code' => 4,
			'text' => "In review"
		],
		"COMPLETED" => [
			'code' => 5,
			'text' => "Completed"
		],
		"CANCELLED" => [
			'code' => 6,
			'text' => "Cancelled"
		],
		"PENDIND_REQUIREMENT" => [
			'code' => 7,
			'text' => "Pending Requirement"
		]
	];
}

function getOrderStatusText($code)
{
	foreach (getOrderStatusList() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

function getOrderStatusCode($key){
	$order_status = getOrderStatusList();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

function getOrderStatusCodes(...$keys){
	$order_status = getOrderStatusList();
	$codes = [];
	foreach($keys as $key){
		if (isset($order_status[$key])) {
			array_push($codes,  $order_status[$key]['code']);
		}
	}
	return $codes;
}

function checkOrderStatus($orderItem, $status){
    $statusCode = getOrderStatusCode($status);
    return $orderItem->status == $statusCode;
}

function orderMenus()
{
    return collect([
        'active' => ['label' => 'Active', 'icon' => ''],
        // 'missing-details' => 'Missing Details',
        //'in-review' => 'Awaiting My Review',
        'delivered' => ['label' => 'Delivered', 'icon' => ''],
        // 'completed' => 'Completed',
        // 'cancelled' => 'Cancelled',
        'all' => ['label' => 'All', 'icon' => ''],
    ]);
}
