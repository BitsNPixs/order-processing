<?php
/**
 * List of application order status
 * @return array
 */
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

/**
 * Get order status text by code
 *
 * @param $code
 * @return string|null
 */
function getOrderStatusText($code)
{
	foreach (getOrderStatusList() as $status) {
		if ($status['code'] == $code) {
			return $status['text'];
		}
	}
	return null;
}

/**
 * Get order status code by key
 *
 * @param $key
 * @return string|null
 */
function getOrderStatusCode($key){
	$order_status = getOrderStatusList();
	if ($order_status[$key]) {
		return $order_status[$key]['code'];
	}
	return null;
}

/**
 * Get list of order status codes by keys
 *
 * @param mixed ...$keys
 * @return array
 */
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

/**
 * Check order item status against given status
 * @param $orderItem
 * @param $status
 * @return bool
 */
function checkOrderStatus($orderItem, $status){
    $statusCode = getOrderStatusCode($status);
    return $orderItem->status == $statusCode;
}

/**
 * Return list of orders sub-menu
 * @return \Illuminate\Support\Collection
 */
function orderMenus()
{
    return collect([
        'active' => ['label' => 'Active', 'icon' => ''],
        'delivered' => ['label' => 'Delivered', 'icon' => ''],
        'all' => ['label' => 'All', 'icon' => ''],
    ]);
}
