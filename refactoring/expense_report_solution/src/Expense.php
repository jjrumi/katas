<?php

abstract class Expense
{
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var float
	 */
	public $amount;

	/**
	 * @param float $amount
	 */
	public function __construct( $amount )
	{
		$this->amount = $amount;
	}

	/**
	 * @return bool
	 */
	abstract public function isOverage();

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}