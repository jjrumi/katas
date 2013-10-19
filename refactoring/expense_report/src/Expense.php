<?php

class Expense
{
	const BREAKFAST		= 0;
	const DINNER		= 1;
	const CAR_RENTAL	= 2;

	/**
	 * @var string
	 */
	public $type;

	/**
	 * @var float
	 */
	public $amount;

	/**
	 * @param string $type
	 * @param float $amount
	 */
	public function __construct( $type, $amount )
	{
		$this->type = $type;
		$this->amount = $amount;
	}
}