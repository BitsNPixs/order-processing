<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Crypt;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function getLastUpdate(Request $request, $orderItemId)
    {

        $clientTimestamp = $request->get('timeStamp');

        $OrderItem = OrderItem::find($orderItemId);
        $serverTimestamp = strtotime($OrderItem->updated_at);
        if ($serverTimestamp > $clientTimestamp) {
            $status = 'updated';
        }
        else{
            $status = 'not-updated';
        }

        return response()->json([
            'status' => $status,
        ]);
    }

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

    public function orderDetails($id)
    {
        $orderItem = OrderItem::find($id);

        if (checkOrderStatus($orderItem, 'PENDIND_REQUIREMENT')){
            return redirect()->route('startOrder', $orderItem);
        }

        abort_if($orderItem == null || $orderItem->order->user->id != Auth::user()->id, 404);

        $chatGroups = $orderItem->chats()
                                ->get()
                                ->groupBy(function($row){
                                    return Carbon::parse($row->created_at)->format('Y-m-d');
                                });

        return view('orderDetails')->with(compact('orderItem', 'chatGroups'));
    }

    // public function acceptOrders($itemid)
    // {
    //     $user = Auth::user();
    //     OrderItem::where('id', $itemid)->update([
    //         'status' => getOrderStatusCode('COMPLETED'),
    //         'completed_time' => date("Y-m-d H:i:s")
    //     ]);
    //     $orderItem = OrderItem::find($itemid);
    //     $user->notify(new OrderComplete($user , $orderItem));

    //     Notification::route('mail', settings('order_accepted', 'ordercomplete.designsin24@bitsnpixs.com'))
    //                 ->notify(new AdminAcceptedJob($user, $orderItem));
    //     $this->auditor->log($orderItem, $user, getJobStatusAuditCode('ACCEPT_ORDER'));
    //     return redirect()->route('orderDetails', $itemid);
    // }

    // public function cancelOrders($itemid)
    // {
    //     $user = Auth::user();
    //     OrderItem::where('id', $itemid)->update([
    //         'status' => getOrderStatusCode('CANCELLED'),
    //     ]);
    //     $orderItem = OrderItem::find($itemid);

    //     Notification::route('mail', settings('order_cancelled', 'delivered.designsin24@bitsnpixs.com'))
    //                 ->notify(new AdminCancelJob($user, $orderItem));
    //     $this->auditor->log($orderItem, $user, getJobStatusAuditCode('CANCEL_ORDER'));
    //     $user->notify(new OrderCancel($user , $orderItem));

    //     return redirect()->route('orders')->with(['msg' => 'Your order cancel request submited. Will get further procedure by call or mail.']);
    // }
}
