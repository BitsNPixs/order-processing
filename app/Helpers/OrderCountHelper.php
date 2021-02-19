<?php
/**
 * @return array
 */
    function pendingRequirementOrderItemStatus()
	{
		return getOrderStatusCodes('PENDIND_REQUIREMENT');
	}

	//Cancelled Order
		function cancelOrderItemStatus()
		{
			return getOrderStatusCodes('CANCELLED');
		}
	//New Order
		function newOrderItemStatus()
		{
			return getOrderStatusCodes('ACTIVE');
		}

	//Working Order
		function workingOrderItemStatus()
		{
			return getOrderStatusCodes('IN_PROGRESS', 'DELIVERED');
		}

	//RevisionRequest
		function revisionRequestItemStatus()
		{
			return getOrderStatusCodes('IN_REVIEW');
		}

	//All Orders
		function allOrdersItemStatus()
		{
			return range(1, 7);
		}
