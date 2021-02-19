<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{
	protected $creatorType;
	protected $creator;


	public function __construct($creator, $type)
	{
		$this->creator = $creator;
		$this->creatorType = $type;
	}

	public function createOrder($customer, $service, $data)
	{
		$quantity = $data['quantity'];
		$servicePrice = isset($data['servicePrice']) ? $data['servicePrice'] : $service->price;

		$order = Order::create([
            'user_id' => $customer->id,
            'sub_total' => $servicePrice * $quantity,
            'tax' => 0,
            'grand_total' => $servicePrice * $quantity,
            'payment_status' => getPaymentStatusCode('UNPAID'),
            'communication_mode' => $data['communication-mode'],
            'status' => 0
        ]);

        $order->update(['invoice_id' => date('Ymdhi') . $order->id]);


        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'service_name' => $service->name,
            'price' => $servicePrice,
            'quantity' => $quantity,
            'status' => 0,
        ]);

        return $order;
	}

	public function activateOrderWithoutPayment(Order $order)
	{
		$this->activateOrder($order, true);
	}

	public function activateOrder(Order $order, $withoutPayment = false)
	{
		// $order = Order::find($orderId);

		$paymentStatus = $withoutPayment? 'PAID' : 'UNPAID';

		$order->update([
            'payment_status' => getPaymentStatusCode($paymentStatus),
            'status' => 1
        ]);

        $order->items()->update([
            'status' => getOrderStatusCode('PENDIND_REQUIREMENT')
        ]);
	}
}
