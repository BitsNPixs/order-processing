<?php

function getPrice($price)
{
	$value = explode(".",$price);
	if (isset($value[1]) && $value[1] == 0)
		return (int) $price;
	else
		return $price;
}

function getCurrency()
{
	return '$';
}