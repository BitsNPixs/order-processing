<?php

namespace App\Http\Controllers;

use App\Http\Controllers\General\OrderController as OrderLogic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem;

class PurchaseController extends Controller
{
	protected $orderLogic;

    public function __construct()
    {
        $this->orderLogic = new OrderLogic(Auth::user(), 'user');
    }

    /**
     * Show order now screen
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getOrderNow($id)
    {
    	$service = Service::where('status', 1)->where('id', $id)->first();
		abort_if($service == null, 404);

		return view('orderNow', compact('service'));
    }

    /**
     * Handle order now post
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postOrderNow(Request $request, $id)
    {
    	$service = Service::where('status', 1)->where('id', $id)->first();
		abort_if($service == null, 404);

		$data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'communication-mode' => ['required', Rule::in(getAllCommunicationModeCodes())],
        ],[
            'quantity.required' => 'Quantity is required',
            'communication-mode.required' => 'Communication Mode is required',
            'communication-mode.in' => 'Communication Mode is not valid',
        ]);

        if ($service->customer_price != null) {
            $data['servicePrice'] = $service->customer_price;
        }

        $user = Auth::user();

		$order = $this->orderLogic->createOrder($user, $service, $data);
        session(['orderId'=> $order->id]);

        $this->orderLogic->activateOrderWithoutPayment($order);

        return redirect()->route('orders');
    }
}
