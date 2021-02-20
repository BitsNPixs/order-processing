<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Show orders screen
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getOrders(Request $request)
    {
        $type = $request->has('type') ? $request->get('type') : 'active';

        switch ($type) {
            case 'active':
                $itemStatus = getOrderStatusCodes('IN_PROGRESS', 'IN_REVIEW', 'NEW', 'PENDIND_REQUIREMENT', 'DELIVERED');
                break;

            case 'missing-details':
                $itemStatus = getOrderStatusCodes('PENDIND_REQUIREMENT');
                break;

            case 'in-review':
                $itemStatus = getOrderStatusCodes('IN_REVIEW');
                break;

            case 'delivered':
                $itemStatus = getOrderStatusCodes('DELIVERED');
                break;

            case 'completed':
                $itemStatus = getOrderStatusCodes('COMPLETED');
                break;

            case 'cancelled':
                $itemStatus = getOrderStatusCodes('CANCELLED');
                break;

            default:
                $itemStatus = range(1, 7);
                $type = 'all';
                break;
        }

        $user =  Auth::user();

        $orders = Order::where('user_id', $user->id)->where('status', 1)->pluck('id');

        $orderItems = OrderItem::whereIn('order_id', $orders)->whereIn('status', $itemStatus)->orderBy('created_at', 'DESC')->paginate();

        return view('orders')->with(compact('orderItems', 'type'));
    }
}
