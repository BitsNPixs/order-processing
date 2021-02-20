<?php
/**
 * Get formatted price
 *
 * @param $price
 * @return int
 */
function getPrice($price)
{
	$value = explode(".",$price);
	if (isset($value[1]) && $value[1] == 0)
		return (int) $price;
	else
		return $price;
}

/**
 * Get app currency symbol
 *
 * @return string
 */
function getCurrency()
{
	return '$';
}
