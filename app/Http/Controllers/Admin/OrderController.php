<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStartWorking($id)
    {
        $orderItem = OrderItem::find($id);

        if (checkOrderStatus($orderItem, 'PENDIND_REQUIREMENT')){
            return redirect()->route('adminStartOrder', $orderItem);
        }

        abort_if($orderItem == null, 404);

        $orderItem->update([
            'status' => getOrderStatusCode('IN_PROGRESS')
        ]);

        return redirect()->route('adminOrderDetails', $orderItem);
    }

    public function getOrders(Request $request, $type = 'archive')
    {
        $orderStatus = 1;

        switch ($type) {
            case 'new':
                $itemStatus = getOrderStatusCodes('NEW', 'PENDIND_REQUIREMENT');
                $meta['title'] = 'New Orders';
                break;

            case 'working':
                $itemStatus = getOrderStatusCodes('IN_PROGRESS');
                $meta['title'] = 'Working Orders';
                break;

            case 'delivered':
                $itemStatus = getOrderStatusCodes('DELIVERED');
                $meta['title'] = 'Delivered Orders';
                break;

            case 'pending-payment':
                $orderStatus = 0;
                $itemStatus = [0];
                $meta['title'] = 'Pending Payment Orders';
                break;

            default:
                $itemStatus = getOrderStatusCodes('COMPLETED');
                $meta['title'] = 'Order Archive';
                break;
        }

        $orderIds = Order::where('status', $orderStatus)->pluck('id');

        $orderItems = OrderItem::whereIn('order_id', $orderIds)->whereIn('status', $itemStatus)->get();

        return view('admin.orders')->with(compact('orderItems', 'type', 'meta'));
    }

    public function getOrderDetails($id)
    {
        $orderItem = OrderItem::find($id);


        abort_if($orderItem == null, 404);

        return view('admin.orderDetails')->with(compact('orderItem'));
    }

}
